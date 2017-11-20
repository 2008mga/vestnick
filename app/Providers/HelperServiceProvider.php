<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    protected $helpers;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->helpers as $helper) {
            require_once $helper;
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // register custom helpers
        $this->helpers = [
            app_path('Helpers/helper.php')
        ];
    }
}
