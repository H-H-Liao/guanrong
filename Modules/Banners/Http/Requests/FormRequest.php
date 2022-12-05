<?php

namespace TypiCMS\Modules\Banners\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'status.*' => 'boolean',
            'button_text.*' => 'nullable',
            'button_link.*' => 'nullable|url',
            'sub_title.*' => 'nullable',
            'summary.*' => 'nullable',
        ];
    }
}
