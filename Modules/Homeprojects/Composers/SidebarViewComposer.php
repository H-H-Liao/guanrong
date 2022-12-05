<?php

namespace TypiCMS\Modules\Homeprojects\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read homeprojects')) {
            return;
        }
        $view->sidebar->group(__('Homepage'), function (SidebarGroup $group) {
            $group->id = 'Homepage';
            $group->weight = 23;
            $group->addItem(__('Homeprojects'), function (SidebarItem $item) {
                $item->id = 'homeprojects';
                $item->icon = config('typicms.homeprojects.sidebar.icon');
                $item->weight = config('typicms.homeprojects.sidebar.weight');
                $item->route('admin::index-homeprojects');
                $item->append('admin::create-homeproject');
            });
        });
    }
}
