<?php

use Illuminate\Contracts\Cache\Factory;
use Rohitpavaskar\Localization\Helpers;



return Cache::rememberForever('translations_'.$directory, function(){
    return Helpers\getTranslations(__DIR__,__FILE__);
});
