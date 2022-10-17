<?php

namespace Juzaweb\AdsManager\Http\Controllers\Backend;

use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\CMS\Traits\ResourceController;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\AdsManager\Http\Datatables\VideoAdDatatable;
use Juzaweb\AdsManager\Models\VideoAds;

class VideoAdsController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'juad::backend.video_ad';

    protected function getDataTable(...$params)
    {
        return new VideoAdDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'name' => [
                    'required',
                    'string',
                    'max:50'
                ]
            ]
        );
    }

    protected function getModel(...$params)
    {
        return VideoAds::class;
    }

    protected function getTitle(...$params)
    {
        return trans('juad::content.video_ads');
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model);
        $data['positions'] = Ads::getPositions();
        return $data;
    }
}
