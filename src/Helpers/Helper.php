<?php

namespace Rohitpavaskar\Localization\Helpers;

use DB;

function getTranslations($lang = 'en') {
    $translations = DB::table('translations')->where('language',$lang)->get();
    $translationArr = array();
    foreach ($translations as $translation) {
        $translationArr[$translation->key] = $translation->text;
    }
    return $translationArr;
}

?>