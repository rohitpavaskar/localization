<?php

use Illuminate\Contracts\Cache\Factory;
use Rohitpavaskar\Localization\Helpers;

$cur_dir = explode(DIRECTORY_SEPARATOR, __DIR__);
$directory = last($cur_dir);

return Cache::rememberForever('translations_'.$directory, function() use($directory){
    return Helpers\getTranslations($directory);
});
