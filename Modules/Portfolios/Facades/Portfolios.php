<?php

namespace TypiCMS\Modules\Portfolios\Facades;

use Illuminate\Support\Facades\Facade;

class Portfolios extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Portfolios';
    }
}
