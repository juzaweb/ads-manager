<?php

namespace Juzaweb\AdsManager\Repositories;

use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\AdsManager\Models\VideoAds;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;
use Juzaweb\CMS\Traits\ResourceRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Juzaweb\Backend\Repositories;
 */
class VideoAdsRepositoryEloquent extends BaseRepositoryEloquent implements VideoAdsRepository
{
    use ResourceRepositoryEloquent;
    
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
        return HookAction::getAdsPositions()->where('type', 'video')->pluck('name', 'key')->toArray();
    }
}
