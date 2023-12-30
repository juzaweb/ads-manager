<?php

namespace Juzaweb\AdsManager\Providers;

use Illuminate\Support\Collection;
use Juzaweb\AdsManager\Actions\AdsManagerAction;
use Juzaweb\AdsManager\Actions\DefaultAdsPositionAction;
use Juzaweb\AdsManager\Repositories;
use Juzaweb\AdsManager\ShortCodes\ADsShortCode;
use Juzaweb\AdsManager\Support\AdsManager;
use Juzaweb\AdsManager\Contracts\AdsManager as AdsManagerContract;
use Juzaweb\CMS\Facades\ActionRegister;
use Juzaweb\CMS\Facades\ShortCode;
use Juzaweb\CMS\Support\HookAction;
use Juzaweb\CMS\Support\ServiceProvider;

class AdsManagerServiceProvider extends ServiceProvider
{
    public array $bindings = [
        Repositories\AdsRepository::class => Repositories\AdsRepositoryEloquent::class,
        Repositories\VideoAdsRepository::class => Repositories\VideoAdsRepositoryEloquent::class
    ];

    public function boot(): void
    {
        HookAction::macro(
            'registerAdsPosition',
            function (string $key, string $type = 'banner', array $args = []) {
                $defaults = [
                    'name' => '',
                    'type' => $type,
                    'key' => $key,
                ];

                $args = array_merge($defaults, $args);

                $this->globalData->set(
                    "ads.{$key}",
                    new Collection($args)
                );
            }
        );

        HookAction::macro(
            'getAdsPositions',
            function (string $key = null) {
                if ($key) {
                    return $this->globalData->get("ads.{$key}");
                }

                return new Collection($this->globalData->get('ads'));
            }
        );

        ActionRegister::register([AdsManagerAction::class, DefaultAdsPositionAction::class]);

        ShortCode::register('ads', ADsShortCode::class);
    }

    public function register(): void
    {
        $this->app->singleton(AdsManagerContract::class, AdsManager::class);
    }
}
