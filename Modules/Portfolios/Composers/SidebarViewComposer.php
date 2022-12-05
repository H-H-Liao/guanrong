<?php

namespace TypiCMS\Modules\Portfolios\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read portfolios')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Portfolios'), function (SidebarItem $item) {
                $item->id = 'portfolios';
                $item->icon = config('typicms.portfolios.sidebar.icon');
                $item->weight = 6;
                $item->route('admin::index-portfolios');
                $item->append('admin::create-portfolio');
            });
        });
    }
}
