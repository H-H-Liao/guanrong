@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;">建議圖片尺寸: 1920 x 1080</div>
<div class="form-row">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Title'), 'title') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Sub Title'), 'sub_title') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('按鈕文字'), 'button_text') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('按鈕連結'), 'button_link')->placeholder('https://') !!}
    </div>
</div>

<div class="form-group">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
{!! TranslatableBootForm::textarea(__('Summary'), 'summary')->addClass('ckeditor-full') !!}
