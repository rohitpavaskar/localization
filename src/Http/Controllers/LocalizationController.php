<?php

namespace Rohitpavaskar\Localization\Http\Controllers;

use DB;
use Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Rohitpavaskar\Localization\Models\Translation;
use Illuminate\Support\Facades\Cache;
use Rohitpavaskar\Localization\Http\Resources\Translation as TranslationResource;
use Rohitpavaskar\Localization\Http\Requests\StoreTranslationRequest;
use Rohitpavaskar\Localization\Http\Requests\UpdateTranslationRequest;
use Rohitpavaskar\Localization\Http\Requests\DeleteTranslationRequest;

class LocalizationController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $advancedFilters = array();
        if (!empty($request->advanced_filter)) {
            $advancedFilters = json_decode($request->advanced_filter, true);
        }

        $lang1 = (isset($advancedFilters['lang_1'])) ? $advancedFilters['lang_1'] : 'en';
        $lang2 = (isset($advancedFilters['lang_2'])) ? $advancedFilters['lang_2'] : 'en';
        $result = Translation::select('translations.*', 't2.text as text_2', 't2.language as language_2')
                ->leftJoin('translations as t2', function($join) use($lang2) {
                    $join->on('t2.key', '=', 'translations.key')
                    ->on('t2.type', '=', 'translations.type')
                    ->on('t2.module', '=', 'translations.module')
                    ->where('t2.language', '=', $lang2);
                })
                ->search($request->filter)
                ->where('translations.language', $lang1)
                ->advancedFilter($advancedFilters)
                ->when($request->sort_name != '', function($query) use ($request) {
                    $query->orderBy($request->sort_name, $request->sort_dir);
                })
                ->paginate($request->size, ['*'], 'pageNumber');
        return TranslationResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslationRequest $request) {
        $translation = new Translation();
        $translation->key = $request->key;
        $translation->text = $request->text;
        $translation->type = $request->type;
        $translation->module = $request->module;
        $translation->language = $request->language;
        $translation->save();
        Cache::forget('translations_' . $request->language . '_' . $request->type);
        Cache::forget('translations_' . $translation->language . '_json');
        return response(
                array(
            "message" => __('crud.created_msg', array('entity' => trans('common.traslation'))),
            "status" => true,
                ), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return new TranslationResource(Translation::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranslationRequest $request, $id) {
        Cache::forget('translations_' . $request->language . '_' . $request->type);
        Cache::forget('translations_' . $request->language . '_json');
        Translation::updateOrCreate(
                ['key' => $request->key, 'type' => $request->type, 'module' => $request->module, 'language' => $request->language], ['text' => $request->text, 'is_updated' => '1']
        );
        return response(
                array(
            "message" => __('crud.updated_msg', array('entity' => trans('common.translation'))),
            "status" => true,
                ), 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTranslationRequest $request, $id) {
        $translation = Translation::findOrFail($id);
        Cache::forget('translations_' . $translation->language . '_' . $translation->type);
        Cache::forget('translations_' . $translation->language . '_json');
        $translation->delete();

        return response(
                array(
            "message" => __('crud.deleted_msg', array('entity' => trans('common.translation'))),
            "status" => true,
                ), 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getJson($lang) {
        return Cache::rememberForever('translations_' . $lang . '_json', function() use($lang) {
                    $translations = DB::table('translations')
                            ->where('language', $lang)
                            ->whereIn('module', ['frontend', 'common'])
                            ->get();
                    $translationArr = array();
                    foreach ($translations as $translation) {
                        $translationArr[$translation->type . '.' . $translation->key] = preg_replace('/:(\w+)/i', '{{${1}}}', $translation->text);
                    }
                    $fallbackTranslations = DB::table('translations')
                            ->where('language', Config::get('app.fallback_locale'))
                            ->whereIn('module', ['frontend', 'common'])
                            ->get();

                    $fallbackTranslationArr = array();
                    foreach ($fallbackTranslations as $translation) {
                        $fallbackTranslationArr[$translation->type . '.' . $translation->key] = preg_replace('/:(\w+)/i', '{{${1}}}', $translation->text);
                    }

                    $finalArr = array_merge($fallbackTranslationArr, $translationArr);

                    return $finalArr;
                });
    }

    public function getTypes() {
        $types = Translation::select('type')
                ->groupBy('type')
                ->get();
        $typesArr = array('all');
        foreach ($types as $type) {
            array_push($typesArr, $type->type);
        }
        return $typesArr;
    }

    public function exportCSV(Request $request) {
        $advancedFilters = array();
        if (!empty($request->advanced_filter)) {
            $advancedFilters = json_decode($request->advanced_filter, true);
        }

        $lang1 = (isset($advancedFilters['lang_1'])) ? $advancedFilters['lang_1'] : 'en';
        $lang2 = (isset($advancedFilters['lang_2'])) ? $advancedFilters['lang_2'] : 'en';
        $result = Translation::select('translations.*', 't2.text as text_2', 't2.language as language_2')
                        ->leftJoin('translations as t2', function($join) use($lang2) {
                            $join->on('t2.key', '=', 'translations.key')
                            ->on('t2.type', '=', 'translations.type')
                            ->on('t2.module', '=', 'translations.module')
                            ->where('t2.language', '=', $lang2);
                        })
                        ->search($request->filter)
                        ->where('translations.language', $lang1)
                        ->advancedFilter($advancedFilters)
                        ->when($request->sort_name != '', function($query) use ($request) {
                            $query->orderBy($request->sort_name, $request->sort_dir);
                        })->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Sample_Lab_Manager.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $languages = \Rohitpavaskar\Localization\Models\Language::all();
        $langArr = array();
        foreach ($languages as $lang) {
            $langArr[$lang->code] = $lang->text;
        }

        $columns = array(
            trans('translations.type'),
            trans('translations.key'),
            $langArr[$lang1],
            $langArr[$lang2]
        );

        $callback = function() use ($columns, $result) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($result as $row) {
                fputcsv($file, array(
                    $row->type,
                    $row->key,
                    $row->text,
                    $row->text_2,
                ));
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    function clearCache($key, $language) {
        $languages = Language::all();
        Cache::forget(str_replace("{{language}}", $language, $key));
        foreach ($languages as $language) {
            if ($language->code == Config::get('app.fallback_locale')) {
                Cache::forget(str_replace("{{language}}", $language, $key));
            }
        }
    }

}
