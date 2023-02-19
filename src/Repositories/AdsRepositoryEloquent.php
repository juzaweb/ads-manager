<?php

namespace Juzaweb\AdsManager\Repositories;

use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;
use Juzaweb\CMS\Traits\ResourceRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Juzaweb\Backend\Repositories;
 */
class AdsRepositoryEloquent extends BaseRepositoryEloquent implements AdsRepository
{
    use ResourceRepositoryEloquent;

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
