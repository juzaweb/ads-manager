<?php

namespace Juzaweb\Modules\AdsManagement\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Juzaweb\Modules\AdsManagement\Enums\BannerAdsType;
use Juzaweb\Modules\AdsManagement\Models\BannerAds;
use Juzaweb\Modules\AdsManagement\Tests\TestCase;

class BannerAdsTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_banner_ads()
    {
        $banner = BannerAds::create([
            'name' => 'Test Banner',
            'type' => BannerAdsType::TYPE_BANNER,
            'body' => 'image.jpg',
            'url' => 'https://example.com',
            'active' => true,
        ]);

        $this->assertDatabaseHas('banner_ads', [
            'name' => 'Test Banner',
        ]);

        $this->assertNotNull($banner->id);
    }

    public function test_get_body_image_type()
    {
        $banner = new BannerAds();
        $banner->type = BannerAdsType::TYPE_BANNER;
        $banner->body = 'image.jpg';
        $banner->url = 'https://example.com';

        $body = $banner->getBody();
        $this->assertStringContainsString('href="https://example.com"', $body);
        $this->assertStringContainsString('src="http://localhost/storage/image.jpg"', $body);
    }

    public function test_get_body_html_type()
    {
        $banner = new BannerAds();
        $banner->type = BannerAdsType::TYPE_HTML;
        $banner->body = '<div>Custom HTML</div>';

        $body = $banner->getBody();
        $this->assertEquals('<div>Custom HTML</div>', $body);
    }

    public function test_get_body_image_type_without_url()
    {
        $banner = new BannerAds();
        $banner->type = BannerAdsType::TYPE_BANNER;
        $banner->body = 'image.jpg';
        $banner->url = null;

        $body = $banner->getBody();

        // Assert that it does not return an empty href which would reload page
        $this->assertStringNotContainsString('href=""', $body);
    }
}
