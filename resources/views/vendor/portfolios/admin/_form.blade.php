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

    <div class="tab-pane fade show active" id="tab-content">
        <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
        {{-- <files-field :init-files="{{ $model->files }}"></files-field> --}}

@include('core::form._title-and-slug')

<div class="row gx-3">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Sub Title'), 'sub_title') !!}
    </div>
    <div class="col-md-6">

    </div>
</div>

<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
{!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}

{!! BootForm::textarea(__('Template'), 'template')->addClass('ckeditor-full')->value(
    '<div class="row">
    <!-- image -->
    <div class="col-md-8">
        <div class="row align-items-stretch savoye-photos">
            <div class="col-md-12 items mb-30">
                <a href="/project/img/slider/3.jpg" class="d-block savoye-photo-item" data-caption="Project page" data-fancybox="gallery"> <img src="/projectimg/slider/3.jpg" alt="" class="img-fluid"> </a>
            </div>
            <div class="col-md-6 items mb-30">
                <a href="/project/img/services/1.jpg" class="d-block savoye-photo-item" data-caption="Project page" data-fancybox="gallery"> <img src="/project/img/services/1.jpg" alt="" class="img-fluid"> </a>
            </div>
            <div class="col-md-6 items mb-30">
                <a href="/project/img/services/2.jpg" class="d-block savoye-photo-item" data-caption="Project page" data-fancybox="gallery"> <img src="/project/img/services/2.jpg" alt="" class="img-fluid"> </a>
            </div>
        </div>
    </div>
    <!-- text -->
    <div class="col-md-4">
        <p>Company non lorem ac erat suscipit bibendum. Nulla facilisi. Sedeuter nunc volutpat, mollis sapien vel, conseyer turpeutionyer masin libero sempe. Fusceler mollis augue sit amet hendrerit vestibulum. Duisteyerionyer venenatis lacus.</p>
        <p>Villa gravida eros ut turpis interdum ornare. Interdum et malesu they adamale fames ac anteipsu pimsine faucibus. Curabitur arcu site feugiat in torto.</p>
        <p><b>Client : </b> Bellway Homes</p>
        <p><b>Number of Homes : </b> 3701</p>
        <p><b>Tenure Mix : </b> 30% affordable, 70% private</p>
        <p><b>Site Size : </b> 12ha</p>
        <p><b>Planning Approved : </b> July 2022</p>
    </div>
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
