<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\ListField;

class Gallery extends ListField
{
    /**
     * Returns the value (an Image) at specified offset.
     *
     * @param mixed $offset The offset to retrieve.
     * @return Image|null
     */
    public function offsetGet(mixed $offset) :? Image
    {
        if (isset($this->value[$offset])) {
            return new Image($this->value[$offset], $this->postId, []);
        }
        return null;
    }

    /**
     * Returns the current element.
     *
     * @return Image
     */
    public function current() : Image
    {
        $value = current($this->value);
        return new Image($value, $this->postId, []);
    }
}
