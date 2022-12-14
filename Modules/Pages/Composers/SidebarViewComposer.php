<?php

namespace TypiCMS\Modules\Pages\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read pages')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Pages'), function (SidebarItem $item) {
                $item->id = 'pages';
                $item->icon = config('typicms.pages.sidebar.icon');
                $item->weight = 1;
                $item->route('admin::index-pages');
            });
        });
    }
}
