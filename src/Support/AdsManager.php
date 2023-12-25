<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\AdsManager\Support;

use Illuminate\Support\Collection;
use Juzaweb\AdsManager\Contracts\AdsManager as AdsManagerContract;
use Juzaweb\CMS\Contracts\GlobalDataContract;

class AdsManager implements AdsManagerContract
{
    public function __construct(protected GlobalDataContract $globalData)
    {
    }

    public function registerPosition(string $key, string $type = 'banner', array $args = []): void
    {
        $defaults = [
            'name' => '',
            'type' => $type,
            'key' => $key,
        ];

        $args = array_merge($defaults, $args);

        $this->globalData->set(
            "ads.{$key}",
            new Collection($args)
        );
    }

    public function positions(string $key = null): ?Collection
    {
        if ($key) {
            return $this->globalData->get("ads.{$key}");
        }

        return new Collection($this->globalData->get('ads'));
    }
}
