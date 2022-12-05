<?php

namespace TypiCMS\Modules\Socialbuttons\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Socialbuttons\Exports\Export;
use TypiCMS\Modules\Socialbuttons\Http\Requests\FormRequest;
use TypiCMS\Modules\Socialbuttons\Models\Socialbutton;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('socialbuttons::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' socialbuttons.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Socialbutton();
        $icons = [
            'ti-instagram' => 'instagram',
            'ti-youtube' => 'youtube',
            'ti-vimeo-alt' => 'vimeo',
            'ti-facebook' => 'facebook',
            'ti-headphone-alt' => '客服',
            'ti-email'=>'email'
        ];
        return view('socialbuttons::admin.create')
            ->with(compact('model','icons'));
    }

    public function edit(socialbutton $socialbutton): View
    {
        $icons = [
            'ti-instagram' => 'instagram',
            'ti-youtube' => 'youtube',
            'ti-vimeo-alt' => 'vimeo',
            'ti-facebook' => 'facebook',
            'ti-headphone-alt' => '客服',
            'ti-email'=>'email'
        ];
        return view('socialbuttons::admin.edit')
            ->with(['model' => $socialbutton,'icons' => $icons]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $socialbutton = Socialbutton::create($request->validated());

        return $this->redirect($request, $socialbutton);
    }

    public function update(socialbutton $socialbutton, FormRequest $request): RedirectResponse
    {
        $socialbutton->update($request->validated());

        return $this->redirect($request, $socialbutton);
    }
}
