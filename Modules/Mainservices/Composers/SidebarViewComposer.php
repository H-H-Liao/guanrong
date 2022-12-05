<?php

namespace TypiCMS\Modules\Mainservices\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read mainservices')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Mainservices'), function (SidebarItem $item) {
                $item->id = 'mainservices';
                $item->icon = config('typicms.mainservices.sidebar.icon');
                $item->weight = config('typicms.mainservices.sidebar.weight');
                $item->route('admin::index-mainservices');
                $item->append('admin::create-mainservice');
            });
        });
    }
}
