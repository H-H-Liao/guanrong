@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<div style="color:red;">建議尺寸:360x209</div>
<div class="row gx-3">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Title'), 'title') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Link'), 'link') !!}
    </div>
</div>

<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
