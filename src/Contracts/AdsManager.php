<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\AdsManager\Contracts;

use Illuminate\Support\Collection;

interface AdsManager
{
    public function registerPosition(string $key, string $type = 'banner', array $args = []): void;

    public function positions(string $key = null): ?Collection;
}
