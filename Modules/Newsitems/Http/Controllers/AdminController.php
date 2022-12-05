<?php

namespace TypiCMS\Modules\Newsitems\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Newsitems\Exports\Export;
use TypiCMS\Modules\Newsitems\Http\Requests\FormRequest;
use TypiCMS\Modules\Newsitems\Models\Newsitem;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('newsitems::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' newsitems.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Newsitem();

        return view('newsitems::admin.create')
            ->with(compact('model'));
    }

    public function edit(newsitem $newsitem): View
    {
        return view('newsitems::admin.edit')
            ->with(['model' => $newsitem]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $newsitem = Newsitem::create($request->validated());

        return $this->redirect($request, $newsitem);
    }

    public function update(newsitem $newsitem, FormRequest $request): RedirectResponse
    {
        $newsitem->update($request->validated());

        return $this->redirect($request, $newsitem);
    }
}
