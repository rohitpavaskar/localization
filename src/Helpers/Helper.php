<?php

namespace Rohitpavaskar\Localization\Helpers;
use Illuminate\Support\Facades\Cache;

use DB;

function getTranslations($file) {
    $fileArr = explode(DIRECTORY_SEPARATOR, $file);
    $lang = $fileArr[count($fileArr)-2];
    $type = str_replace('.php', '', $fileArr[count($fileArr)-1]);
    return Cache::rememberForever('translations_' . $lang . '_' . $type, function() use($lang, $type) {
                $translations = DB::table('translations')
                        ->where('language', $lang)
                        ->where('type', $type)
                        ->get();
                $translationArr = array();
                foreach ($translations as $translation) {
                    $translationArr[$translation->key] = $translation->text;
                }
                return $translationArr;
            });
}

?>