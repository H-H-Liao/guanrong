{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : config('app.locale')) !!}
{!! BootForm::hidden('id') !!}

{!! BootForm::text(__('姓名') . ' <span class="asterisk">*</span>', 'title')->disable() !!}
{!! BootForm::text(__('聯絡電話') . ' <span class="asterisk">*</span>', 'phone')->disable() !!}
{!! BootForm::email(__('信箱') . '<span class="asterisk">*</span>', 'email')->disable() !!}
{!! BootForm::email(__('主旨') . '<span class="asterisk">*</span>', 'subject')->disable() !!}
{!! BootForm::textarea(__('Message') . '', 'message')->disable() !!}
<div class="form-group">
    <span class="asterisk">*</span> @lang('Mandatory fields')
</div>
<hr>
{!! BootForm::textarea(__('Memo') . '', 'memo') !!}

