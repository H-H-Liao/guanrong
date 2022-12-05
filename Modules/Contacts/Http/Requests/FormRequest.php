<?php

namespace TypiCMS\Modules\Contacts\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
            return [
                'g-recaptcha-response' => 'recaptcha',
                // OR since v4.0.0
                recaptchaFieldName() => recaptchaRuleName(),
                'title' => 'required|max:255',
                'phone' => 'required|max:255',
                'email' => 'required|email:rfc,dns|max:255',
                'subject'=> 'required|max:255',
                'message' => 'required',
                'locale' => 'required|max:5',
                'my_name' => 'honeypot',
                'my_time' => 'required|honeytime:5',
            ];
    }

    public function messages()
    {
        return [
            "recaptcha" => __("Please verify by reCaptcha"),
            "title.required" => "姓名為必填",
            "phone.required" => "聯絡電話為必填",
            "subject.required" => "主旨為必填",
            "message.required" => "訊息為必填",
            "type.required" => "聯絡項目為必填"
        ];
    }
}
