<?php

namespace Juzaweb\AdsManager\Providers;

use Juzaweb\CMS\Support\ServiceProvider;

class AutoloadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'juad');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'juad');
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
