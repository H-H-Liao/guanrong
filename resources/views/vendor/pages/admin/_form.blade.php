@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#tab-content" data-bs-toggle="tab">{{ __('Content') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#tab-meta" data-bs-toggle="tab">{{ __('Meta') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#tab-options" data-bs-toggle="tab">{{ __('Options') }}</a>
    </li>
</ul>

<div class="tab-content">

    <div class="tab-pane fade show active" id="tab-content">

        <file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>

        @if($model && ($model->module == 'shopproducts' ))
        <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
        <div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;">建議圖片尺寸: 364 x 570</div>

        @endif
        <div class="row gx-3">
            <div class="col-md-6">
                {!! TranslatableBootForm::text(__('Title'), 'title') !!}
            </div>
            <div class="col-md-6">
            @foreach ($locales as $lang)
                <div class="mb-3 form-group-translation">
                    <label class="form-label" for="slug[{{ $lang }}]"><span>{{ __('Url') }}</span> ({{ $lang }})</label>
                    <div class="input-group">
                        <span class="input-group-text">{{ $model->present()->parentUri($lang) }}</span>
                        <input class="form-control @if ($errors->has('slug.'.$lang))is-invalid @endif" type="text" name="slug[{{ $lang }}]" id="slug[{{ $lang }}]" value="{{ $model->translate('slug', $lang) }}" data-slug="title[{{ $lang }}]" data-language="{{ $lang }}">
                        <button class="btn btn-outline-secondary btn-slug" type="button">{{ __('Generate') }}</button>
                        {!! $errors->first('slug.'.$lang, '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        {!! TranslatableBootForm::hidden('uri') !!}
        <div class="mb-3">
            {!! TranslatableBootForm::hidden('status')->value(0) !!}
            {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
        </div>
        @if($model && ($model->module == '' && (($model->template == 'home2'  )|| ($model->template == 'about'  ) || ($model->template == 'traffic'  ) ))
            ||
            $model->module == 'shopcategories' || $model->module == 'contacts')
            <div>
        @else
            <div hidden>
        @endif
            {!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
        </div>
        @if($model && ( $model->module == 'contacts'))
        {!! BootForm::textarea(__('Example'), 'example')->addClass('ckeditor-full')->value(" <h5>Let's start a project</h5>
        <p>Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days. We will be happy to answer your questions.</p>
        <p><b>公司名稱 :</b> 冠融科技有限公司</p>
        <p><b>統一編號 :</b> 90695494</p>
        <p><b>聯絡電話 :</b> +886 03-3814277</p>
        <p><b>電子郵件 :</b> info@gmail.com</p>
        <p><b>公司地址 :</b> 337桃園市大園區三石里三塊石47之28號1樓</p>")->disable() !!}
        @endif
        @if($model && ($model->module == '' && $model->template == 'home2'))
        {!! BootForm::textarea(__('Example'), 'example')->addClass('ckeditor-full')->value('    <!-- Projects -->
        <div class="savoye-project section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center animate-box" data-animate-effect="fadeInUp">
                        <div class="section-title">Our Projects</div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-12">
                            <div class="projects3 animate-box" data-animate-effect="fadeInUp">
                                <figure><a href="project-page.html"><img src="/project/img/projects/2.jpg" alt="" class="img-fluid"></a></figure>
                                <div class="caption">
                                    <h6>Architecture</h6>
                                    <h4>Woodenist House Lumberjack</h4>
                                    <p>Savoye inila duman aten elit finibus vivera alacus themone the drudean seneice miuscibe noneten the fermen. Savoye architecture duiman elit finibus viverra nec a lacus themo deane sene fermen.</p>
                                    <a href="project-page.html" class="btn float-btn flat-btn">Discover</a>
                                </div>
                            </div>
                            <div class="projects3 left animate-box" data-animate-effect="fadeInUp">
                                <figure><a href="project-page.html"><img src="/project/img/projects/4.jpg" alt="" class="img-fluid"></a></figure>
                                <div class="caption">
                                    <h6>Architecture</h6>
                                    <h4>Arch Cloud Honna Didenton Villa</h4>
                                    <p>Savoye inila duman aten elit finibus vivera alacus themone the drudean seneice miuscibe noneten the fermen. Savoye architecture duiman elit finibus viverra nec a lacus themo deane sene fermen.</p>
                                    <a href="project-page.html" class="btn float-btn flat-btn">Discover</a>
                                </div>
                            </div>
                            <div class="projects3 animate-box" data-animate-effect="fadeInUp">
                                <figure><a href="project-page.html"><img src="/project/img/projects/6.jpg" alt="" class="img-fluid"></a></figure>
                                <div class="caption">
                                    <h6>Architecture</h6>
                                    <h4>Twin Forestland Home</h4>
                                    <p>Savoye inila duman aten elit finibus vivera alacus themone the drudean seneice miuscibe noneten the fermen. Savoye architecture duiman elit finibus viverra nec a lacus themo deane sene fermen.</p>
                                    <a href="project-page.html" class="btn float-btn flat-btn">Discover</a>
                                </div>
                            </div>
                            <div class="projects3 left animate-box" data-animate-effect="fadeInUp">
                                <figure><a href="project-page.html"><img src="/project/img/projects/3.jpg" alt="" class="img-fluid"></a></figure>
                                <div class="caption">
                                    <h6>Exterior Design</h6>
                                    <h4>Geometric Building</h4>
                                    <p>Savoye inila duman aten elit finibus vivera alacus themone the drudean seneice miuscibe noneten the fermen. Savoye architecture duiman elit finibus viverra nec a lacus themo deane sene fermen.</p>
                                    <a href="project-page.html" class="btn float-btn flat-btn">Discover</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>')->disable() !!}
        @endif


        @if($model && ($model->module == '' && $model->template == 'about'))
        {!! BootForm::textarea(__('Example'), 'example')->addClass('ckeditor-full')->value('    <!-- About -->
        <div class="about section-padding">
            <div class="container">
                <div class="row">
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
                </div>
            </div>
        </div>')->disable() !!}
        @endif

        @can('read page_sections')
        @if ($model->id && (($model->module == '' && ($model->template == 'home' ||($model->template == 'research-and-development') ))))
        <item-list
            url-base="/api/pages/{{ $model->id }}/sections"
            locale="{{ config('typicms.content_locale') }}"
            fields="id,page_id,position,status,title,section"
            table="page_sections"
            title="sections"
            include=""
            appends="area"
            :searchable="['title']"
            :sorting="['position']">

            <template slot="add-button" v-if="$can('create page_sections')">
                @include('core::admin._button-create', ['url' => route('admin::create-page_section', $model->id), 'module' => 'page_sections'])
            </template>

            <template slot="columns" slot-scope="{ sortArray }">
                <item-list-column-header name="checkbox" v-if="$can('update page_sections')||$can('delete page_sections')"></item-list-column-header>
                <item-list-column-header name="edit" v-if="$can('update page_sections')"></item-list-column-header>
                <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
                <item-list-column-header name="position" sortable :sort-array="sortArray" :label="$t('Position')"></item-list-column-header>
                <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
                <item-list-column-header name="sction"  label="區塊"></item-list-column-header>
            </template>

            <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
                <td class="checkbox" v-if="$can('update page_sections')||$can('delete page_sections')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
                <td v-if="$can('update page_sections')">@include('core::admin._button-edit', ['segment' => 'sections', 'module' => 'page_sections'])</td>
                <td><item-list-status-button :model="model"></item-list-status-button></td>
                <td><item-list-position-input :model="model"></item-list-position-input></td>
                <td v-html="model.title_translated"></td>
                <td >@{{ model.area}}</td>
            </template>

        </item-list>
        @endif
        @endcan

    </div>

    <div class="tab-pane fade" id="tab-meta">
        {!! TranslatableBootForm::text(__('Meta title'), 'meta_title') !!}
        {!! TranslatableBootForm::text(__('Meta keywords'), 'meta_keywords') !!}
        {!! TranslatableBootForm::text(__('Meta description'), 'meta_description') !!}
    </div>

    <div class="tab-pane fade" id="tab-options">
        <div class="mb-3">
            {!! BootForm::hidden('is_home')->value(0) !!}
            {!! BootForm::checkbox(__('Is home'), 'is_home') !!}
            {!! BootForm::hidden('private')->value(0) !!}
            {!! BootForm::checkbox(__('Private'), 'private') !!}
            {!! BootForm::hidden('redirect')->value(0) !!}
            {!! BootForm::checkbox(__('Redirect to first child'), 'redirect') !!}
        </div>
        {!! BootForm::select(__('Module'), 'module', TypiCMS::getModulesForSelect())->disable($model->subpages->count() > 0)->formText($model->subpages->count() ? __('A page containing subpages cannot be linked to a module') : '') !!}
        {!! BootForm::select(__('Template'), 'template', TypiCMS::templates()) !!}
        {!! BootForm::textarea(__('Css'), 'css') !!}
        {!! BootForm::textarea(__('Js'), 'js') !!}
    </div>

</div>
