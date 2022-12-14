@extends('core::admin.master')

@section('title', $model->title)

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'contacts'])
        <h1 class="header-title @if (!$model->present()->title)text-muted @endif">
            {{ $model->title ?: __('Untitled') }}
        </h1>
    </div>

    {!! BootForm::open()->put()->action(route('admin::update-contact', $model->id))->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('contacts::admin._form')
    {!! BootForm::close() !!}

@endsection
