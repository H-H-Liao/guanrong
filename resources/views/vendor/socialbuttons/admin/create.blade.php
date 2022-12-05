@extends('core::admin.master')

@section('title', __('New socialbutton'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'socialbuttons'])
        <h1 class="header-title">@lang('New socialbutton')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-socialbuttons'))->multipart()->role('form') !!}
        @include('socialbuttons::admin._form')
    {!! BootForm::close() !!}

@endsection
