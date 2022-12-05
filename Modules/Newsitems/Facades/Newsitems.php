<?php

namespace TypiCMS\Modules\Newsitems\Facades;

use Illuminate\Support\Facades\Facade;

class Newsitems extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Newsitems';
    }
}
