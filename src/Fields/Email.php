<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Traits\Stringable;

class Email extends Field
{
    use Stringable;

    public function obfuscate(): Email
    {
        $this->value = $this->value ? antispambot($this->value) : null;

        return $this;
    }
}
