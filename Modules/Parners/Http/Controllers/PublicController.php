<?php

namespace TypiCMS\Modules\Parners\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Parners\Models\Parner;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $list = Parner::published()->orderBy('position','ASC')->with('image')->get();

        return view('parners::public.index')
            ->with(compact('list'));
    }
}
