<?php

namespace TypiCMS\Modules\Search\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'search_brand' => 'required|integer',
            'search_list' => 'nullable|integer',
            'search_product_name' => 'nullable',
            'search_years' => 'nullable',
        ];
    }
}
