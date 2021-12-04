<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\ListField;
use Otomaties\AcfObjects\Repeater\Row;

class Repeater extends ListField
{
    /**
     * Returns the value (a row) at specified offset.
     *
     * @param [type] $offset The offset to retrieve.
     * @return Row|null
     */
    public function offsetGet($offset) : ?Row
    {
        if (isset($this->value[ $offset ])) {
            return new Row($this->value[ $offset ]);
        }
        return null;
    }
    /**
     *
     * Returns the current element.
     *
     * @return Row
     */
    public function current() : Row
    {
        $value = current($this->value);
        return new Row($value);
    }
}
