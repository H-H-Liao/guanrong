<?php

namespace TypiCMS\Modules\Socialbuttons\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read socialbuttons')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Socialbuttons'), function (SidebarItem $item) {
                $item->id = 'socialbuttons';
                $item->icon = config('typicms.socialbuttons.sidebar.icon');
                $item->weight = 2;
                $item->route('admin::index-socialbuttons');
                $item->append('admin::create-socialbutton');
            });
        });
    }
}
