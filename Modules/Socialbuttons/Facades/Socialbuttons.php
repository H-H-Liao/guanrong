<?php

namespace TypiCMS\Modules\Socialbuttons\Facades;

use Illuminate\Support\Facades\Facade;

class Socialbuttons extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Socialbuttons';
    }
}
