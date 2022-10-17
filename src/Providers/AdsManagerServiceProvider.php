<?php

namespace Juzaweb\AdsManager\Providers;

use Illuminate\Support\Collection;
use Juzaweb\AdsManager\AdsManagerAction;
use Juzaweb\CMS\Facades\ActionRegister;
use Juzaweb\CMS\Support\HookAction;
use Juzaweb\CMS\Support\ServiceProvider;

class AdsManagerServiceProvider extends ServiceProvider
{
    public function boot()
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

        ActionRegister::register(AdsManagerAction::class);
    }

    public function register()
    {
        //
    }
}
