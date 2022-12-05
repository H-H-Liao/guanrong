<?php

namespace TypiCMS\Modules\Services\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Services\Models\Service;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $list = Service::published()->orderBy('position','ASC')->with('image')->get();

        return view('services::public.index')
            ->with(compact('list'));
    }

    public function show($slug): View
    {
        $model = Service::published()->whereSlugIs($slug)->firstOrFail();

        return view('services::public.show')
            ->with(compact('model'));
    }
}
