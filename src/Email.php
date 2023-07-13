<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

/**
 * Email Field
 */
class Email extends Field
{
    public function obfuscate() : string
    {
        return antispambot($this->value);
    }
}
