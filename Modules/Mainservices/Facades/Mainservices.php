<?php

namespace TypiCMS\Modules\Mainservices\Facades;

use Illuminate\Support\Facades\Facade;

class Mainservices extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Mainservices';
    }
}
