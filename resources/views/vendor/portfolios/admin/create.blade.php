@extends('core::admin.master')

@section('title', __('New portfolio'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'portfolios'])
        <h1 class="header-title">@lang('New portfolio')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-portfolios'))->multipart()->role('form') !!}
        @include('portfolios::admin._form')
    {!! BootForm::close() !!}

@endsection
