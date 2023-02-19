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

use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\AdsManager\Repositories\AdsRepository;
use Juzaweb\CMS\Abstracts\BackendResource;

class BannerAds extends BackendResource
{
    protected string $key = 'banner-ads';
    protected string $label = 'jwad::content.banner_ads';
    protected string $repository = AdsRepository::class;
    protected array $validator = [];

    public function getMenu(): array
    {
        return [
            'icon' => 'fa fa-file',
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
            'body' => [
                'type' => 'editor',
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
                    'options' => Ads::getPositions(),
                ]
            ],
        ];
    }

    public function getValidator(): array
    {
        return [
            'name' => 'required',
            'position' => 'required|string',
        ];
    }
}
