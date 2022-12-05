<?php

namespace App;


trait HasHomeList
{
    public function getHomeList()
    {
        return self::published()
                    ->where('show_homepage->'.app()->getLocale(), 1)
                    ->orderBy('position', 'ASC')
                    ->get();
    }
}
