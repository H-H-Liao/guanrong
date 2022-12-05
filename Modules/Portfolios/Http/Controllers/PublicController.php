<?php

namespace TypiCMS\Modules\Portfolios\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Portfolios\Models\Portfolio;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $list = Portfolio::published()->orderBy('position','ASC')->with('image')->get();

        return view('portfolios::public.index')
            ->with(compact('list'));
    }

    public function show($slug): View
    {
        $model = Portfolio::published()->whereSlugIs($slug)->firstOrFail();

        $next = Portfolio::published()
                ->where('id','>',$model->id)
                ->orderBy('position','ASC')
                ->first();
        $prev = Portfolio::published()
                ->where('id','<',$model->id)
                ->orderBy('position','DESC')
                ->first();


        return view('portfolios::public.show')
            ->with(compact('model','prev','next'));
    }
}
