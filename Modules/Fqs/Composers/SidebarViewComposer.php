<?php

namespace TypiCMS\Modules\Fqs\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read fqs')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Fqs'), function (SidebarItem $item) {
                $item->id = 'fqs';
                $item->icon = config('typicms.fqs.sidebar.icon');
                $item->weight = config('typicms.fqs.sidebar.weight');
                $item->route('admin::index-fqs');
                $item->append('admin::create-fq');
            });
        });
    }
}
