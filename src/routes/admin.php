<?php

use Juzaweb\AdsManager\Http\Controllers\Backend\AdsManagerController;
use Juzaweb\AdsManager\Http\Controllers\Backend\VideoAdsController;

Route::group(
    ['prefix' => 'banner-ads'],
    function () {
        Route::jwResource('/', AdsManagerController::class);
    }
);

Route::jwResource('video-ads', VideoAdsController::class);
