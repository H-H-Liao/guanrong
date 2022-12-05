<?php

namespace TypiCMS\Modules\Mainservices\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'status.*' => 'boolean',
            'icon.*' => 'nullable|max:255',
            'link.*' => 'nullable|max:255',
        ];
    }
}
