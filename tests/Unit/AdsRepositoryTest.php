<?php

namespace Juzaweb\Modules\AdsManagement\Tests\Unit;

use Juzaweb\Modules\AdsManagement\AdsRepository;
use Juzaweb\Modules\AdsManagement\Tests\TestCase;

class AdsRepositoryTest extends TestCase
{
    public function test_register_position()
    {
        $repo = new AdsRepository();
        $repo->position('header', function () {
            return [
                'name' => 'Header Banner',
                'type' => 'banner',
            ];
        });

        $positions = $repo->positions();
        $this->assertCount(1, $positions);
        $this->assertEquals('Header Banner', $positions->first()->name);
        $this->assertEquals('banner', $positions->first()->type);
    }

    public function test_video_ads_enabled()
    {
        $repo = new AdsRepository();
        $this->assertFalse($repo->isVideoAdsEnabled());

        $repo->enableVideoAds(true);
        $this->assertTrue($repo->isVideoAdsEnabled());
    }
}
