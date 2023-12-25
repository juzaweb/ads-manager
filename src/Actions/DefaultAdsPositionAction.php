<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\AdsManager\Actions;

use Juzaweb\AdsManager\Contracts\AdsManager;
use Juzaweb\CMS\Abstracts\Action;

class DefaultAdsPositionAction extends Action
{
    public function __construct(protected AdsManager $adsManager)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->addAction(self::INIT_ACTION, [$this, 'registerDefaultPositions']);
    }

    public function registerDefaultPositions(): void
    {
        $this->adsManager->registerPosition('post_header', 'banner', ['name' => trans('cms::app.post_header')]);
        $this->adsManager->registerPosition('post_footer', 'banner', ['name' => trans('cms::app.post_footer')]);
        $this->adsManager->registerPosition('bottom_left', 'banner', ['name' => trans('cms::app.bottom_left')]);
        $this->adsManager->registerPosition('bottom_right', 'banner', ['name' => trans('cms::app.bottom_right')]);
    }
}
