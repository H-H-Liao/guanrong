<?php

namespace TypiCMS\Modules\Homeprojects\Facades;

use Illuminate\Support\Facades\Facade;

class Homeprojects extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Homeprojects';
    }
}
