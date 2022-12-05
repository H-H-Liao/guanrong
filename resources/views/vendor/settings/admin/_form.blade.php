<div class="row">
    <div class="mb-3 col-sm-12">
        <button class="btn-primary btn" type="submit">{{ __('Save') }}</button>
    </div>
</div>

<label class="form-label">{{ __('Website title') }}</label>
@foreach ($locales as $lang)
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text">{{ strtoupper($lang) }}</span>
            <input class="form-control" type="text" name="{{ $lang }}[website_title]" value="{{ $data->$lang->website_title ?? '' }}">
        </div>
    </div>
@endforeach

<label class="form-label">{{ __('Publish website') }}</label>

<div class="mb-3">
@foreach ($locales as $lang)
<div class="form-check form-check-inline">
    <input type="hidden" name="{{ $lang }}[status]" value="0">
    <input class="form-check-input" type="checkbox" name="{{ $lang }}[status]" id="{{ $lang }}[status]" value="1" @if (isset($data->$lang) and $data->$lang->status)checked @endif>
    <label class="form-check-label" for="{{ $lang }}[status]">{{ strtoupper($lang) }}</label>
</div>
@endforeach
</div>


<div class="fieldset-media fieldset-image">
    {!! BootForm::hidden('image') !!}
    @if (isset($data->image) and $data->image)
    <div class="fieldset-preview">
        <img class="img-fluid" src="{{ Storage::url('settings/'.$data->image) }}" alt="">
        <small hidden class="text-danger delete-attachment" data-table="settings" data-id="" data-field="image">@lang('Delete')</small>
    </div>
    @endif
    <div class="fieldset-field">
        {!! BootForm::file(__('Logo'), 'image') !!}
        <div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;"></div>
    </div>
</div>



{!! BootForm::select(__('Administration Language'), 'admin_locale', array_combine($locales, $locales)) !!}

{!! BootForm::email(__('聯絡電子郵件'), 'webmaster_email') !!}


<div class="fieldset-media fieldset-image">
    {!! BootForm::hidden('footer_logo') !!}
    @if (isset($data->footer_logo) and $data->footer_logo)
    <div class="fieldset-preview">
        <img class="img-fluid" src="{{ Storage::url('settings/'.$data->footer_logo) }}" alt="">
        <small hidden class="text-danger delete-attachment" data-table="settings" data-id="" data-field="footer_logo">@lang('Delete')</small>
    </div>
    @endif
    <div class="fieldset-field">
        {!! BootForm::file(__('下方區塊Banner'), 'footer_logo') !!}
        <div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;">建議圖片尺寸:1920x1080 </div>
    </div>
</div>

@foreach ($locales as $lang)
{!! BootForm::text('下方區塊1標題('.__($lang).')', 'block1_'.$lang) !!}
{!! BootForm::text('下方區塊1內容('.__($lang).')', 'block1_value_'.$lang) !!}
@endforeach

<hr>
@foreach ($locales as $lang)
{!! BootForm::text('下方區塊2標題('.__($lang).')', 'block2_'.$lang) !!}
{!! BootForm::text('下方區塊2內容('.__($lang).')', 'block2_value_'.$lang) !!}
@endforeach
<hr>
@foreach ($locales as $lang)
{!! BootForm::text('下方區塊3標題('.__($lang).')', 'block3_'.$lang) !!}
{!! BootForm::text('下方區塊3內容('.__($lang).')', 'block3_value_'.$lang) !!}
@endforeach
<hr>
@foreach ($locales as $lang)
{!! BootForm::text('下方區塊4標題('.__($lang).')', 'block4_'.$lang) !!}
{!! BootForm::text('下方區塊4內容('.__($lang).')', 'block4_value_'.$lang) !!}
@endforeach

@foreach ($locales as $lang)
{!! BootForm::text('Copyright('.__($lang).')', 'copyright_'.$lang) !!}
@endforeach


{!! BootForm::text(__('Google Analytics 追蹤 ID'), 'google_analytics_id')->placeholder('XX-00000000-0') !!}


{!! BootForm::hidden('lang_chooser')->value(0) !!}
