<?php

namespace Juzaweb\AdsManager;

use Juzaweb\AdsManager\Http\Controllers\Frontend\VideoAdsController;
use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\AdsManager\Support\BackendResource\BannerAds;
use Juzaweb\AdsManager\Support\BackendResource\VideoAds;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;

class AdsManagerAction extends Action
{
    public function handle()
    {
        $this->addFilter('posts.get_content', [$this, 'addAdsPost']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenus']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'registerResources']);
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerFrontendAjax']);
    }

    public function addAdminMenus()
    {
        HookAction::addAdminMenu(
            trans('jwad::content.ads_manager'),
            'ads-manager',
            [
                'icon' => 'fa fa-code',
                'position' => 51,
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

    public function registerResources()
    {
        $this->hookAction->registerResource(BannerAds::class);
        $this->hookAction->registerResource(VideoAds::class);
    }
}
