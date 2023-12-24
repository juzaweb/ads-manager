<?php

namespace Juzaweb\AdsManager\Actions;

use Juzaweb\AdsManager\Http\Controllers\Frontend\VideoAdsController;
use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\AdsManager\Support\Resources\BannerAds;
use Juzaweb\AdsManager\Support\Resources\VideoAds;
use Juzaweb\CMS\Abstracts\Action;

class AdsManagerAction extends Action
{
    public function handle(): void
    {
        $this->addFilter('posts.get_content', [$this, 'addAdsPost']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenus']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'registerResources']);
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerFrontendAjaxs']);
    }

    public function addAdminMenus(): void
    {
        $this->hookAction->addAdminMenu(
            trans('jwad::content.ads'),
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

    public function registerFrontendAjaxs(): void
    {
        $this->hookAction->registerFrontendAjax(
            'video-ads',
            [
                'callback' => [VideoAdsController::class, 'getAds']
            ]
        );
    }

    public function registerResources(): void
    {
        $this->hookAction->registerResource(BannerAds::class);
        $this->hookAction->registerResource(VideoAds::class);
    }
}
