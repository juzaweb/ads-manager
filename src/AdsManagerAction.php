<?php

namespace Juzaweb\AdsManager;

use Juzaweb\AdsManager\Http\Controllers\Frontend\VideoAdsController;
use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\AdsManager\Repositories\AdsRepository;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;

class AdsManagerAction extends Action
{
    public function handle()
    {
        $this->addFilter('posts.get_content', [$this, 'addAdsPost']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenus']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminManagements']);
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerFrontendAjax']);
    }

    public function addAdminManagements()
    {
        $this->hookAction->registerResourceManagement(
            'banner-ads',
            [
                'label' => trans('juad::content.banner_ads'),
                'repository' => AdsRepository::class,
                'menu' => [
                    'icon' => 'fa fa-file',
                    'position' => 1,
                    'parent' => 'ads-manager'
                ],
                'fields' => [
                    'name' => [
                        'type' => 'text',
                    ],
                    'body' => [
                        'type' => 'editor',
                    ],
                    'active' => [
                        'type' => 'select',
                        'sidebar' => true,
                        'data' => [
                            'options' => [
                                '1' => trans('cms::app.enabled'),
                                '0' => trans('cms::app.disabled'),
                            ]
                        ],
                    ],
                    'position' => [
                        'type' => 'select',
                        'sidebar' => true,
                        'data' => [
                            'options' => Ads::getPositions(),
                        ]
                    ],
                ]
            ]
        );
    }

    public function addAdminMenus()
    {
        HookAction::addAdminMenu(
            trans('juad::content.ads_manager'),
            'ads-manager',
            [
                'icon' => 'fa fa-file',
                'position' => 51,
            ]
        );

        /*HookAction::registerAdminPage(
            'banner-ads',
            [
                'title' => trans('juad::content.banner_ads'),
                'menu' => [
                    'icon' => 'fa fa-file',
                    'position' => 1,
                    'parent' => 'ads-manager'
                ]
            ]
        );
        */
        HookAction::registerAdminPage(
            'video-ads',
            [
                'title' => trans('juad::content.video_ads'),
                'menu' => [
                    'icon' => 'fa fa-video',
                    'position' => 2,
                    'parent' => 'ads-manager'
                ]
            ]
        );
    }

    public function addAdsPost($content): string
    {
        $botAds = Ads::where('position', '=', 'post_footer')
            ->whereActive(1)
            ->get(['body']);

        foreach ($botAds as $topAd) {
            $content .= $topAd->body;
        }

        $str = '';
        $topAds = Ads::where('position', '=', 'post_header')
            ->whereActive(1)
            ->get(['body']);
        foreach ($topAds as $topAd) {
            $str .= $topAd->body;
        }

        return $str . $content;
    }

    public function registerFrontendAjax()
    {
        HookAction::registerFrontendAjax(
            'video-ads',
            [
                'callback' => [VideoAdsController::class, 'getAds']
            ]
        );
    }
}
