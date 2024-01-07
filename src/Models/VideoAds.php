<?php

namespace Juzaweb\AdsManager\Models;

use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\ResourceModel;
use Juzaweb\CMS\Traits\UseUUIDColumn;
use Juzaweb\CMS\Traits\UUIDPrimaryKey;
use Juzaweb\Network\Traits\Networkable;

class VideoAds extends Model
{
    use ResourceModel, UUIDPrimaryKey, Networkable, UseUUIDColumn;

    protected $table = 'juad_video_ads';

    protected $fillable = [
        'name',
        'title',
        'video',
        'url',
        'position',
        'offset',
        'options',
        'active',
        'views',
    ];

    public $casts = ['options' => 'array'];
}
