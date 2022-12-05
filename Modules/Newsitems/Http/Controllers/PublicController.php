<?php

namespace TypiCMS\Modules\Newsitems\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Newsitems\Models\Newsitem;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $list = Newsitem::published()
                ->releaseDate()
                ->orderBy('show_date', 'DESC')
                ->paginate(10);

        return view('newsitems::public.index')
            ->with(compact('list'));
    }

    public function show($slug): View
    {
        $model = Newsitem::published()->whereSlugIs($slug)->firstOrFail();
        $next = Newsitem::published()
                ->releaseDate()
                ->where('show_date','>',$model->show_date)
                ->orderBy('show_date','ASC')
                ->first();
        $prev = Newsitem::published()
                ->releaseDate()
                ->where('show_date','<',$model->show_date)
                ->orderBy('show_date','DESC')
                ->first();
        return view('newsitems::public.show')
            ->with(compact('model','prev','next'));
    }
}
