<?php

namespace Otomaties\AcfObjects\Facades;

use Illuminate\Support\Facades\Facade;

class AcfObjects extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'acf-objects';
    }
}
