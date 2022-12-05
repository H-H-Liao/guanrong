<?php

namespace TypiCMS\Modules\Services\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Services\Exports\Export;
use TypiCMS\Modules\Services\Http\Requests\FormRequest;
use TypiCMS\Modules\Services\Models\Service;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('services::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' services.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Service();

        return view('services::admin.create')
            ->with(compact('model'));
    }

    public function edit(service $service): View
    {
        return view('services::admin.edit')
            ->with(['model' => $service]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $service = Service::create($request->validated());

        return $this->redirect($request, $service);
    }

    public function update(service $service, FormRequest $request): RedirectResponse
    {
        $service->update($request->validated());

        return $this->redirect($request, $service);
    }
}
