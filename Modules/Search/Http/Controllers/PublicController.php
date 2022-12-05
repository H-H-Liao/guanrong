<?php

namespace TypiCMS\Modules\Search\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Search\Http\Requests\FormRequest;
use TypiCMS\Modules\Shopproducts\Models\Shopproduct;

class PublicController extends BasePublicController
{
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            's' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back();
        }

        $list = Shopproduct::published()
                ->where('title','like','%'.$request->s.'%')
                ->orWhere('spec','like','%'.$request->s.'%')
                ->orderBy('position')
                ->paginate(12);

        $s=$request->s;

        return view('search::public.index')
            ->with(compact('s','list'));
    }
}
