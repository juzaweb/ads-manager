<?php

namespace Juzaweb\AdsManager\Providers;

use Juzaweb\CMS\Support\ServiceProvider;

class AutoloadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    public function register()
    {
        //$this->app->register(RouteServiceProvider::class);
    }
}
