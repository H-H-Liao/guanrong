<?php

namespace TypiCMS\Modules\Fqs\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Fqs\Exports\Export;
use TypiCMS\Modules\Fqs\Http\Requests\FormRequest;
use TypiCMS\Modules\Fqs\Models\Fq;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('fqs::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' fqs.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Fq();

        return view('fqs::admin.create')
            ->with(compact('model'));
    }

    public function edit(fq $fq): View
    {
        return view('fqs::admin.edit')
            ->with(['model' => $fq]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $fq = Fq::create($request->validated());

        return $this->redirect($request, $fq);
    }

    public function update(fq $fq, FormRequest $request): RedirectResponse
    {
        $fq->update($request->validated());

        return $this->redirect($request, $fq);
    }
}
