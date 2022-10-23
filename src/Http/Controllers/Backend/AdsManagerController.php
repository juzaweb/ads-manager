<?php

namespace Juzaweb\AdsManager\Http\Controllers\Backend;

use Juzaweb\AdsManager\Http\Datatables\AdsManagerDatatable;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;
use Juzaweb\AdsManager\Models\Ads;
use Juzaweb\CMS\Traits\ResourceController;

class AdsManagerController extends PageController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'juad::backend.ads';

    protected function getDataTable(...$params): AdsManagerDatatable
    {
        return (new AdsManagerDatatable());
    }

    protected function validator(array $attributes, ...$params): array
    {
        $positions = array_keys(Ads::getPositions('banner'));

        return [
            'name' => 'required|max:50',
            'active' => 'required|in:0,1',
            'position' => 'required|string|max:50|in:' . implode(',', $positions),
        ];
    }

    protected function getModel(...$params): string
    {
        return Ads::class;
    }

    protected function getTitle(...$params)
    {
        return $this->findPageOrFail()['title'];
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model);
        $data['positions'] = Ads::getPositions();
        return $data;
    }
}
