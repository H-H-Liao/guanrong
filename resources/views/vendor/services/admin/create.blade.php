@extends('core::admin.master')

@section('title', __('New service'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'services'])
        <h1 class="header-title">@lang('New service')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-services'))->multipart()->role('form') !!}
        @include('services::admin._form')
    {!! BootForm::close() !!}

@endsection
