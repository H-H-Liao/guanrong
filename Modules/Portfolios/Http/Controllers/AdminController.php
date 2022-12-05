<?php

namespace TypiCMS\Modules\Portfolios\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Portfolios\Exports\Export;
use TypiCMS\Modules\Portfolios\Http\Requests\FormRequest;
use TypiCMS\Modules\Portfolios\Models\Portfolio;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('portfolios::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' portfolios.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Portfolio();

        return view('portfolios::admin.create')
            ->with(compact('model'));
    }

    public function edit(portfolio $portfolio): View
    {
        return view('portfolios::admin.edit')
            ->with(['model' => $portfolio]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $portfolio = Portfolio::create($request->validated());

        return $this->redirect($request, $portfolio);
    }

    public function update(portfolio $portfolio, FormRequest $request): RedirectResponse
    {
        $portfolio->update($request->validated());

        return $this->redirect($request, $portfolio);
    }
}
