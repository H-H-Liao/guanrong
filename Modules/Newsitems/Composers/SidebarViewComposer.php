<?php

namespace TypiCMS\Modules\Newsitems\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read newsitems')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Newsitems'), function (SidebarItem $item) {
                $item->id = 'newsitems';
                $item->icon = config('typicms.newsitems.sidebar.icon');
                $item->weight = 5;
                $item->route('admin::index-newsitems');
                $item->append('admin::create-newsitem');
            });
        });
    }
}
