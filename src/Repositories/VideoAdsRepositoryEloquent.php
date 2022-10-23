<?php

namespace Juzaweb\AdsManager\Repositories;

use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\AdsManager\Models\VideoAds;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Juzaweb\Backend\Repositories;
 */
class VideoAdsRepositoryEloquent extends BaseRepositoryEloquent implements VideoAdsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return VideoAds::class;
    }

    public function getPositions(): array
    {
        return HookAction::getAdsPositions()->where('type', 'banner')->pluck('name', 'key')->toArray();
    }
}
