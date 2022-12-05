<?php

namespace TypiCMS\Modules\Contacts\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class BackendFormRequest extends AbstractFormRequest
{
    public function rules()
    {
            return [
                'locale' => 'required|max:5',
                'memo' => 'nullable',
                'my_name' => 'honeypot',
                'my_time' => 'required|honeytime:5',
            ];
    }

    public function messages()
    {
        return [
            "recaptcha" => __("Please verify by reCaptcha"),
        ];
    }
}
