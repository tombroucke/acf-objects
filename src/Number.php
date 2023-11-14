<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;
use Otomaties\AcfObjects\Traits\Stringable;
use Otomaties\AcfObjects\Traits\Numeric;

class Number extends Field
{
    use Stringable;
    use Numeric;
}
