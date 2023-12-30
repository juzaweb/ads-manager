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

class ADsShortCode
{
    public function register($shortcode, $content, $compiler, $name, $viewData): string
    {
        return Ads::where(['position' => $content])->first()?->getBody() ?? '';
    }
}
