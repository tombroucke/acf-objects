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
     * @var array<string, string>
     */
    protected array $attributes = [];

    /**
     * Set attributes
     *
     * @param array<string, string> $attributes The array of attributes
     * @return self
     */
    public function attributes(array $attributes = []) : self
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[ $key ] = $value;
        }
        return $this;
    }

    /**
     * Get defined attribute
     *
     * @param string $key
     * @return string|null
     */
    public function getAttribute(string $key) : ?string
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
    }

    /**
     * Convert attribute array to string for output
     *
     * @return string
     */
    private function attributesString() : string
    {
        if (empty($this->attributes)) {
            return '';
        }
        return ' ' . implode(' ', array_map(
            function ($attribute, $value) {
                return $attribute .'="'. htmlspecialchars($value) .'"';
            },
            array_keys($this->attributes),
            $this->attributes
        ));
    }
}
