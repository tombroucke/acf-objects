<?php
namespace Otomaties\AcfObjects\Traits;

trait Numeric
{
    /**
     * Convert to int
     *
     * @return int
     */
    public function toInt() : int
    {
        return (int)$this->value();
    }

    /**
     * Convert to float
     *
     * @return float
     */
    public function toFloat() : float
    {
        return (float)$this->value();
    }
}
