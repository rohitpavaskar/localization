<?php

namespace Rohitpavaskar\Localization;

use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider {

    /**
     * Publishes configuration file.
     *
     * @return  void
     */
    public function boot() {
        $this->registerHelpers();

        $this->publishes([
            __DIR__ . '/config/localization.php' => config_path('localization.php'),
                ], 'localization');

        $this->publishes([
            __DIR__ . '/lang' => resource_path('lang'),
        ]);

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
        ]);
    }

    /**
     * Make config publishment optional by merging the config from the package.
     *
     * @return  void
     */
    public function register() {
        $this->mergeConfigFrom(
                __DIR__ . '/config/localization.php', 'localization'
        );
    }

    /**
     * Register helpers file
     */
    public function registerHelpers() {
        // Load the helpers in app/Http/helpers.php
        if (file_exists($file = __DIR__ . '/Helpers/Helper.php')) {
            require_once $file;
        }
    }

}
