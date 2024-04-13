<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\AdsManager\ShortCodes;

use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\CMS\Support\ShortCode\Compilers\ShortCode;

class ADSShortCode
{
    /**
     * @param ShortCode $shortcode
     * @param $content
     * @param $compiler
     * @param $name
     * @param array $viewData
     * @return string
     */
    public function register($shortcode, $content, $compiler, $name, $viewData): string
    {
        $canShowAds = apply_filters('jwad.can_show_ads', true);

        if (!$canShowAds) {
            return '';
        }

        if ($uuid = $shortcode->getAttribute('id')) {
            return Ads::where(['uuid' => $uuid])->first()?->getBody() ?? '';
        }

        return Ads::where(['position' => $content])->first()?->getBody() ?? '';
    }
}
