<?php

namespace Juzaweb\AdsManager\Models;

use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\ResourceModel;
use Juzaweb\CMS\Traits\UUIDPrimaryKey;

class VideoAds extends Model
{
    use ResourceModel, UUIDPrimaryKey;

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
    ];

    public $casts = ['options' => 'array'];
}
