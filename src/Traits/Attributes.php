<?php
namespace Otomaties\AcfObjects\Traits;

/**
 * Set html attributes
 */
trait Attributes
{
    /**
     * The array of attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Set attributes
     *
     * @param array $attributes The array of attributes
     * @return self
     */
    public function attributes(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[ $key ] = $value;
        }
        return $this;
    }
}
