<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 * @license    GNU V2
 */

use Juzaweb\Modules\AdsManagement\Ads;

if (! function_exists('ads_position')) {
    function ads_position(string $position): ?string
    {
        return app(Ads::class)->getBanner($position)?->getBody();
    }
}
