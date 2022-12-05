@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<div class="row gx-3">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Title'), 'title') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('ICON'), 'icon') !!}
        請複製:<a href="https://icons.getbootstrap.com/" target="__blank">https://icons.getbootstrap.com/</a>的 Icon font
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Link'), 'link') !!}
    </div>
</div>

<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
