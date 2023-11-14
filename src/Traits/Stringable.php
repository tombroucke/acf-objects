<?php
namespace Otomaties\AcfObjects\Traits;

/**
 * Convert to string
 */
trait Stringable
{
    /**
     * Convert to string
     *
     * @return string
     */
    public function toString() : string
    {
        return $this->__toString();
    }
}
