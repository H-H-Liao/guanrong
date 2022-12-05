@extends('core::admin.master')

@section('title', __('New fq'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'fqs'])
        <h1 class="header-title">@lang('New fq')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-fqs'))->multipart()->role('form') !!}
        @include('fqs::admin._form')
    {!! BootForm::close() !!}

@endsection
