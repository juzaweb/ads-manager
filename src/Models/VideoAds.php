<?php

namespace Juzaweb\AdsManager\Models;

use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\ResourceModel;

class VideoAds extends Model
{
    use ResourceModel;

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
