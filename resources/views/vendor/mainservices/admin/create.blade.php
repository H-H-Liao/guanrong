@extends('core::admin.master')

@section('title', __('New mainservice'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'mainservices'])
        <h1 class="header-title">@lang('New mainservice')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-mainservices'))->multipart()->role('form') !!}
        @include('mainservices::admin._form')
    {!! BootForm::close() !!}

@endsection
