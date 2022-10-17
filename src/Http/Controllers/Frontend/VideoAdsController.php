<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Juzaweb\AdsManager\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Juzaweb\AdsManager\Models\VideoAds;
use Juzaweb\AdsManager\Support\Vast\Document;
use Juzaweb\AdsManager\Support\Vast\Factory;
use Juzaweb\CMS\Http\Controllers\FrontendController;

class VideoAdsController extends FrontendController
{
    public function getAds(Request $request): Response|Document
    {
        $position = $request->input('position');
        $id = $request->input('id');

        if (empty($position)) {
            return $this->renderNoneAds();
        }

        $video = $this->getVideoAds($position, $id);
        if (empty($video)) {
            return $this->renderNoneAds();
        }

        $factory = new Factory();
        $document = $factory->create('4.1');

        $ad1 = $document
            ->createInLineAdSection()
            ->setId('ad1')
            ->setAdSystem($video->name)
            ->setAdTitle($video->title)
            ->addImpression('http://ad.server.com/impression', 'imp1');

        $linearCreative = $ad1
            ->createLinearCreative()
            ->setDuration(128)
            ->setId($video->id)
            ->setAdId('pre')
            ->setVideoClicksClickThrough($video->url)
            ->addVideoClicksClickTracking($video->url);

        $linearCreative
            ->createMediaFile()
            ->setProgressiveDelivery()
            ->setType('video/mp4')
            ->setBitrate(2500)
            ->setUrl(upload_url($video->video));

        return response((string) $document, 200, ['Content-Type' => 'application/xml']);
    }

    protected function getVideoAds(string $position, ?string $id): ?VideoAds
    {
        $builder = VideoAds::where(['position' => $position, 'active' => 1]);
        if ($id) {
            $builder->where(['id' => $id]);
        } else {
            $builder->inRandomOrder();
        }

        return $builder->first();
    }

    protected function renderNoneAds(): Document
    {
        $factory = new Factory();
        return $factory->create('4.1');
    }
}
