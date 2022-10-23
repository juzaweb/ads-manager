<?php

namespace Juzaweb\AdsManager\Repositories;

use Juzaweb\CMS\Repositories\BaseRepository;

/**
 * Interface CommentRepository.
 *
 * @package namespace Juzaweb\Backend\Repositories;
 */
interface VideoAdsRepository extends BaseRepository
{
    public function getPositions(): array;
}
