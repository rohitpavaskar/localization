<?php

namespace Rohitpavaskar\Localization\Helpers;

use DB;

function getTranslations($direcory, $file) {

    $cur_dir = explode(DIRECTORY_SEPARATOR, $direcory);
    $lang = last($cur_dir);
    
    $file = str_replace('.php', '', $file);
dd($file);
    $translations = DB::table('translations')
            ->where('language', $lang)
            ->get();
    $translationArr = array();
    foreach ($translations as $translation) {
        $translationArr[$translation->key] = $translation->text;
    }
    return $translationArr;
}

?>