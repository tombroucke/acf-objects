<?php

namespace Otomaties\AcfObjects\Fields;

use Carbon\Carbon;
use Otomaties\AcfObjects\Contracts\FieldContract;
use Otomaties\AcfObjects\Traits\Stringable;

class FallbackField extends Field
{
    use Stringable;

    public function default(mixed $value): FieldContract
    {
        if ($value instanceof Carbon) {
            return DateTimePicker::parse($value);
        }

        if (! $this->isSet()) {
            $this->value = $value;
        }

        return $this;
    }
}
