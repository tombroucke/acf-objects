<?php

namespace Otomaties\AcfObjects\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed getField(string $selector, mixed $postId = false, bool $formatValue = true)
 *
 * @see \Otomaties\AcfObjects\AcfObjects
 */
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
