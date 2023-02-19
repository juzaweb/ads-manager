<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Juzaweb\AdsManager\Support\BackendResource;

use Juzaweb\AdsManager\Repositories\VideoAdsRepository;
use Juzaweb\CMS\Abstracts\BackendResource;

class VideoAds extends BackendResource
{
    protected string $key = 'video-ads';
    protected string $label = 'jwad::content.video_ads';
    protected string $repository = VideoAdsRepository::class;
    protected array $validator = [];

    protected VideoAdsRepository $videoAdsRepository;

    public function __construct(VideoAdsRepository $videoAdsRepository)
    {
        $this->videoAdsRepository = $videoAdsRepository;
    }

    public function getMenu(): array
    {
        return [
            'icon' => 'fa fa-code',
            'position' => 1,
            'parent' => 'ads-manager'
        ];
    }

    public function getFields(): array
    {
        return [
            'name' => [
                'type' => 'text',
            ],
            'title' => [
                'type' => 'text',
            ],
            'video' => [
                'label' => trans('jwad::content.video'),
                'type' => 'upload_url',
            ],
            'row' => [
                'type' => 'row',
                'fields' => [
                    'col1' => [
                        'type' => 'col',
                        'col' => 6,
                        'fields' => [
                            'offset' => [
                                'label' => __('Offset'),
                                'type' => 'text',
                            ],
                        ]
                    ],
                    'col2' => [
                        'type' => 'col',
                        'col' => 6,
                        'fields' => [
                            'options[skipoffset]' => [
                                'label' => __('Skipoffset'),
                                'data' => [
                                    'default' => 5
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'url' => [
                'type' => 'text',
            ],
            'active' => [
                'type' => 'select',
                'sidebar' => true,
                'data' => [
                    'options' => [
                        '1' => trans('cms::app.enabled'),
                        '0' => trans('cms::app.disabled'),
                    ]
                ],
            ],
            'position' => [
                'type' => 'select',
                'sidebar' => true,
                'data' => [
                    'options' => $this->videoAdsRepository->getPositions(),
                ]
            ],
        ];
    }

    public function getValidator(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50'
            ],
            'position' => [
                'required',
                'string'
            ],
            'active' => [
                'required',
                'in:0,1'
            ]
        ];
    }
}
