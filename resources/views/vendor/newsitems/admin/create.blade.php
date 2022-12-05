@extends('core::admin.master')

@section('title', __('New newsitem'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'newsitems'])
        <h1 class="header-title">@lang('New newsitem')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-newsitems'))->multipart()->role('form') !!}
        @include('newsitems::admin._form')
    {!! BootForm::close() !!}

@endsection
