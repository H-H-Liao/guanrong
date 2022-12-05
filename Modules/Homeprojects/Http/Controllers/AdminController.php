<?php

namespace TypiCMS\Modules\Homeprojects\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Homeprojects\Exports\Export;
use TypiCMS\Modules\Homeprojects\Http\Requests\FormRequest;
use TypiCMS\Modules\Homeprojects\Models\Homeproject;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('homeprojects::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' homeprojects.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Homeproject();

        return view('homeprojects::admin.create')
            ->with(compact('model'));
    }

    public function edit(homeproject $homeproject): View
    {
        return view('homeprojects::admin.edit')
            ->with(['model' => $homeproject]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $homeproject = Homeproject::create($request->validated());

        return $this->redirect($request, $homeproject);
    }

    public function update(homeproject $homeproject, FormRequest $request): RedirectResponse
    {
        $homeproject->update($request->validated());

        return $this->redirect($request, $homeproject);
    }
}
