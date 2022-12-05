@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#tab-content" data-bs-toggle="tab">{{ __('Content') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#tab-meta" data-bs-toggle="tab">{{ __('Meta') }}</a>
    </li>
</ul>
<div class="tab-content">

<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<div style="color:red;">建議尺寸:800x941</div>
@include('core::form._title-and-slug')
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
{!! TranslatableBootForm::textarea(__('Summary'), 'summary')->rows(4) !!}
{!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
{!! BootForm::textarea(__('Template'), 'template')->addClass('ckeditor-full')->value(
    '<p>Architectural design nulla facilisi sedeuter nunc volutpat molli sapien veconseyer turpeutionyer mase libero sempe. Fusceler mollis augue sit amet hendrerit vestibulum. Duisteyerionyer venenatis lacus. Web gravida eros utturpis interdum ornare. Interdum et malesu they adamale fames ache urabitur arcu.</p>
<p>Architectural nulla facilisi sedeuter nunc volutpat molli sapien veconseyer turpeutionyer mase libero sempe. Fusce mollis augue sit amet hendrerit vestibulum. Duisteyerionyer venenatis lacus.</p>
<br>
<div class="row align-items-stretch savoye-photos">
    <div class="col-md-6 items mb-30">
        <a href="/project/img/services/1.jpg" class="d-block savoye-photo-item" data-caption="Savoye Architecture" data-fancybox="gallery"> <img src="/project/img/services/1.jpg" alt="" class="img-fluid"> </a>
    </div>
    <div class="col-md-6 items mb-30">
        <a href="/project/img/services/2.jpg" class="d-block savoye-photo-item" data-caption="Savoye Architecture" data-fancybox="gallery"> <img src="/project/img/services/2.jpg" alt="" class="img-fluid"> </a>
    </div>
    <div class="col-md-12 items mb-30">
        <a href="/project/img/slider/3.jpg" class="d-block savoye-photo-item" data-caption="Savoye Architecture" data-fancybox="gallery"> <img src="/project/img/slider/3.jpg" alt="" class="img-fluid"> </a>
    </div>
</div>'
)->disable() !!}



</div>

<div class="tab-pane fade" id="tab-meta">
    {!! TranslatableBootForm::text(__('Meta title'), 'meta_title') !!}
    {!! TranslatableBootForm::text(__('Meta keywords'), 'meta_keywords') !!}
    {!! TranslatableBootForm::text(__('Meta description'), 'meta_description') !!}
</div>
</div>
