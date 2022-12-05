@extends('core::admin.master')

@section('title', __('New parner'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'parners'])
        <h1 class="header-title">@lang('New parner')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-parners'))->multipart()->role('form') !!}
        @include('parners::admin._form')
    {!! BootForm::close() !!}

@endsection
