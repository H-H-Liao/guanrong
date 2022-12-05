<?php

namespace TypiCMS\Modules\Parners\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read parners')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Parners'), function (SidebarItem $item) {
                $item->id = 'parners';
                $item->icon = config('typicms.parners.sidebar.icon');
                $item->weight = config('typicms.parners.sidebar.weight');
                $item->route('admin::index-parners');
                $item->append('admin::create-parner');
            });
        });
    }
}
