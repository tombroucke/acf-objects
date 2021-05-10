<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Group extends Field
{
    public function get(string $param)
    {
        return $this->value[ $param ];
    }
}
