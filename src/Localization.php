<?php

namespace Rohitpavaskar\Localization;

use Illuminate\Support\Facades\Route;

class Localization {

    /**
     * Binds the Localization routes into the controller.
     *
     * @param  callable|null  $callback
     * @param  array  $options
     * @return void
     */
    public static function routes() {
        Route::get('/localizations/csv', '\Rohitpavaskar\Localization\Http\Controllers\LocalizationController@exportCSV');
        Route::get('/localizations/types', '\Rohitpavaskar\Localization\Http\Controllers\LocalizationController@getTypes');
        Route::get('/localizations/json/{lang}.json', '\Rohitpavaskar\Localization\Http\Controllers\LocalizationController@getJson');
        Route::resource('/localizations', '\Rohitpavaskar\Localization\Http\Controllers\LocalizationController');
    }

}
