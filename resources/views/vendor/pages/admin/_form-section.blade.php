@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('page_id')->value($page->id) !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>

@if($model && ($model->section =='storycase'))
    <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>

@endif


@if($model && ($model->section =='image' ))
    <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
    <div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;">建議圖片尺寸: 1920 x 550</div>
    <file-field label="手機版圖片" type="image" field="mobile_image_id" :init-file="{{ $model->mobile_image ?? 'null' }}"></file-field>
    <div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;">建議圖片尺寸: 767 x 963</div>
@endif

<div class="row gx-3">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Title'), 'title') !!}
    </div>
    <div class="col-md-6">
        {!! BootForm::select(__('區塊'), 'section', $area) !!}
    </div>
</div>
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
<div>
    @if($model && ($model->section =='top' || $model->section == 'cart_memo'  ))
        {!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
    @elseif($model && ($model->section =='alert' || $model->section =='about'  ))
        {!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
    @elseif($model && ($model->section =='banner2'))
        <div hidden>

        </div>
    @else
        <div hidden>
            {!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
        </div>
    @endif



    @if($model && ($model->section =='about'))
    {!! BootForm::textarea(__('Template'), 'tamplate')->addClass('ckeditor-full')->disable()->value('  <div class="row">
        <div class="col-md-6">
            <div class="section-title">25 Years of Experience</div>
            <p>Architecture innovation tristique usto duision vitae diam neque nivamus aestan atene artines arinianu ateli finibus viverra nec lacus. Nedana theme edino setlie suscipe no cuvva inila duman aten elit finibus vivera alacus.</p>
            <p>Design inilla duiman at elit finibus viverra nec a lacus themo the drudea senele misuscipit non sagie the fermen. Viverra tristique jusio the ivite dianne onen nivami acsestion architecture augue artine.</p>
            <p>Architecture innovation tristique usto duision vitae diam neque nivamus aesta atene artines arinianu ateli finibus viverra nec lacus.</p>
        </div>
        <div class="col-md-6">
            <div class="about-img">
                <div class="img"> <img src="/project/img/about.png" class="img-fluid" alt=""> </div>
            </div>
        </div>
    </div>') !!}
    @endif



</div>
@if ($model->id && ($model->section == 'jumbotron'))
*請至側邊欄中，首頁>>Banners管理項目
@endif
@if ($model->id && ($model->section == 'project'))
*請至側邊欄中，首頁>>關於我們管理項目
@endif
@if($model->id && ($model->section =='news' ))
*自動顯示最新三則最新消息
@endif
