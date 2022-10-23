<?php

namespace Juzaweb\AdsManager\Repositories;

use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Juzaweb\Backend\Repositories;
 */
class AdsRepositoryEloquent extends BaseRepositoryEloquent implements AdsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Ads::class;
    }
}
