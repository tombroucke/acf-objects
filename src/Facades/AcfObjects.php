<?php

namespace Otomaties\AcfObjects\Facades;

use Illuminate\Support\Facades\Facade;
use Otomaties\AcfObjects\Contracts\CollectionContract;
use Otomaties\AcfObjects\Contracts\FieldContract;

/**
 * @method static FieldContract | CollectionContract | bool getField(string $selector, mixed $postId = false, bool $formatValue = true)
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
