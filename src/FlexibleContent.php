<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\ListField;
use Otomaties\AcfObjects\FlexibleContent\Row;

class FlexibleContent extends ListField
{
    /**
     * Returns the value (a row) at specified offset.
     *
     * @param mixed $offset The offset to retrieve.
     * @return Row|null
     */
    public function offsetGet(mixed $offset) :? Row
    {
        if (isset($this->value[$offset])) {
            return new Row($this->value[$offset]);
        }
        return null;
    }

    /**
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
