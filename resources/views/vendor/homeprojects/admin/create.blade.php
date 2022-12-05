@extends('core::admin.master')

@section('title', __('New homeproject'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'homeprojects'])
        <h1 class="header-title">@lang('New homeproject')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-homeprojects'))->multipart()->role('form') !!}
        @include('homeprojects::admin._form')
    {!! BootForm::close() !!}

@endsection
