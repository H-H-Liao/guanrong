<?php

namespace TypiCMS\Modules\Pages\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class PageSectionFormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'page_id' => 'required|integer',
            'position' => 'nullable|integer',
            'image_id' => 'nullable|integer',
            'mobile_image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'section' => 'nullable|string',
            'status.*' => 'boolean',
            'body.*' => 'nullable',
        ];
    }
}
