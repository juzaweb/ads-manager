<?php

namespace Juzaweb\AdsManager\Http\Controllers\Backend;

use Juzaweb\AdsManager\Repositories\VideoAdsRepository;
use Juzaweb\CMS\Abstracts\DataTable;
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

    protected VideoAdsRepository $videoAdsRepository;
    protected string $viewPrefix = 'juad::backend.video_ad';

    public function __construct(VideoAdsRepository $videoAdsRepository)
    {
        $this->videoAdsRepository = $videoAdsRepository;
    }

    protected function getDataTable(...$params): DataTable
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
                ],
                'position' => [
                    'required',
                    'string'
                ],
                'active' => [
                    'required',
                    'in:0,1'
                ],
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return VideoAds::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('juad::content.video_ads');
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model);
        $data['positions'] = $this->videoAdsRepository->getPositions();
        return $data;
    }
}
