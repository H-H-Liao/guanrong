<?php

namespace TypiCMS\Modules\Mainservices\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Mainservices\Exports\Export;
use TypiCMS\Modules\Mainservices\Http\Requests\FormRequest;
use TypiCMS\Modules\Mainservices\Models\Mainservice;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('mainservices::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' mainservices.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Mainservice();

        return view('mainservices::admin.create')
            ->with(compact('model'));
    }

    public function edit(mainservice $mainservice): View
    {
        return view('mainservices::admin.edit')
            ->with(['model' => $mainservice]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $mainservice = Mainservice::create($request->validated());

        return $this->redirect($request, $mainservice);
    }

    public function update(mainservice $mainservice, FormRequest $request): RedirectResponse
    {
        $mainservice->update($request->validated());

        return $this->redirect($request, $mainservice);
    }
}
