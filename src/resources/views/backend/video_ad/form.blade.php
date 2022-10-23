@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])

        <div class="row">
            <div class="col-md-8">
                {{ Field::text($model, 'name', ['required' => true]) }}

                {{ Field::text($model, 'title') }}

                {{ Field::uploadUrl($model, 'video', ['label' => __('Video'), 'required' => true]) }}

                <div class="row">
                    <div class="col-md-6">
                        {{ Field::text($model, 'offset', ['label' => __('Offset'), 'default' => 1]) }}
                    </div>

                    <div class="col-md-6">
                        {{ Field::text($model, 'options[skipoffset]', [
                                'label' => __('Skipoffset'),
                                'default' => 5
                             ])
                        }}
                    </div>
                </div>

                {{ Field::text($model, 'url') }}
            </div>

            <div class="col-md-4">
                {{ Field::select($model, 'active', [
                    'options' => [
                        '1' => trans('cms::app.enabled'),
                        '0' => trans('cms::app.disabled'),
                    ],
                    'required' => true
                ]) }}

                {{ Field::select($model, 'position', [
                    'options' => $positions,
                    'required' => true
                ]) }}
            </div>
        </div>

    @endcomponent
@endsection
