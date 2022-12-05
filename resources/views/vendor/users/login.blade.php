@extends('core::admin.master')

@section('title', __('Login'))

@section('bodyClass', 'auth-background')

@section('page-header')
@endsection

@section('sidebar')
@endsection
@section('mainClass')

@endsection
@section('errors')
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('project/css/all.min.css') }}">
<div id="login" class="container-login auth-container ">

    @include('users::_logo')

    {!! BootForm::open()->addClass('auth-container-form') !!}

        <h1 class="auth-container-title">{{ __('Login') }}</h1>
        @include('users::_status')

        {!! BootForm::email(__('<i class="far fa-envelope"></i>'), 'email')->addClass('border')->addClass('form-control-lg')->autofocus(true)->required() !!}
        {!! BootForm::password(__('<i class="fas fa-unlock-alt"></i>'), 'password')->addClass('border')->addClass('form-control-lg')->required() !!}

        <div class="form-group">
            {!! BootForm::checkbox(__('記住我'), 'remember') !!}
        </div>

        <div class="form-group">
            {!! BootForm::submit(__('登 入'), 'btn-primary')->addClass('btn-lg btn-block') !!}
            <i class="fas fa-chevron-right"></i>
        </div>

    {!! BootForm::close() !!}

    @if (config('typicms.register'))
    <p class="alert alert-warning alert-not-a-member">
        @lang('Not a member?') <a class="alert-link" href="{{ route(app()->getLocale().'::register') }}">@lang('Become a member')</a> @lang('and get access to all the content of our website.')
    </p>
    @endif

    <p class="auth-container-back-to-website">
        <a class="auth-container-back-to-website-link" href="{{ TypiCMS::homeUrl() }}"><span class="fa fa-angle-left fa-fw"></span>{{ __('回到網站') }}</a>
    </p>
</div>

@endsection
