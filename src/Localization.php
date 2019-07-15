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
    public static function routes($callback = null, array $options = []) {
        Route::resource('/localizations', '\Rohitpavaskar\Localization\Http\Controllers\LocalizationController');
    }

}
