<?php

namespace TypiCMS\Modules\Fqs\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Fqs\Models\Fq;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $list = Fq::published()->orderBy('position','ASC')->with('image')->get();

        return view('fqs::public.index')
            ->with(compact('list'));
    }
}
