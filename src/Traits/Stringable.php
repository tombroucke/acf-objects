<?php

namespace Otomaties\AcfObjects\Traits;

/**
 * Convert to string
 */
trait Stringable
{
    /**
     * Convert to string
     */
    public function toString(): string
    {
        return $this->__toString();
    }

    /**
     * Convert to string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
