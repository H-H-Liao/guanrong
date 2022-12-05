<?php

namespace TypiCMS\Modules\Services\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read services')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Services'), function (SidebarItem $item) {
                $item->id = 'services';
                $item->icon = config('typicms.services.sidebar.icon');
                $item->weight = 4;
                $item->route('admin::index-services');
                $item->append('admin::create-service');
            });
        });
    }
}
