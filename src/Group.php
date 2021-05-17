<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Group extends Field
{
    /**
     * Get field value by key
     *
     * @param string $param The field key to fetch
     * @return mixed
     */
    public function get(string $param)
    {
        return $this->value[ $param ];
    }
}
