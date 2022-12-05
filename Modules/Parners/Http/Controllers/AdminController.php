<?php

namespace TypiCMS\Modules\Parners\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Parners\Exports\Export;
use TypiCMS\Modules\Parners\Http\Requests\FormRequest;
use TypiCMS\Modules\Parners\Models\Parner;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('parners::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' parners.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Parner();

        return view('parners::admin.create')
            ->with(compact('model'));
    }

    public function edit(parner $parner): View
    {
        return view('parners::admin.edit')
            ->with(['model' => $parner]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $parner = Parner::create($request->validated());

        return $this->redirect($request, $parner);
    }

    public function update(parner $parner, FormRequest $request): RedirectResponse
    {
        $parner->update($request->validated());

        return $this->redirect($request, $parner);
    }
}
