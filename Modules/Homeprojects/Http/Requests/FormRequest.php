<?php

namespace TypiCMS\Modules\Homeprojects\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'sub_title.*' => 'nullable|max:255',
            'button_text.*' => 'nullable|max:255',
            'button_link.*' => 'nullable|max:255',
            'status.*' => 'boolean',
            'body.*' => 'nullable',
        ];
    }
}
