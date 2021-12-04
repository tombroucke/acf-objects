<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\ListField;

class Gallery extends ListField
{
    /**
     * Returns the value (an Image) at specified offset.
     *
     * @param [type] $offset The offset to retrieve.
     * @return Image|null
     */
    public function offsetGet($offset) : ?Image
    {
        if (isset($this->value[ $offset ])) {
            return new Image($this->value[ $offset ], $this->post_id, []);
        }
        return null;
    }

    /**
     * Returns the current element.
     *
     * @return Image
     */
    public function current()
    {
        $value = current($this->value);
        return new Image($value, $this->post_id, []);
    }
}
