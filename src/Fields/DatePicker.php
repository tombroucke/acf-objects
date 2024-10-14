<?php

namespace Otomaties\AcfObjects\Fields;

use Carbon\Carbon;
use Otomaties\AcfObjects\Contracts\FieldContract;

class DatePicker extends Carbon implements FieldContract
{
    public function getValue(): mixed
    {
        return $this;
    }

    public function isSet(): bool
    {
        return true;
    }

    public static function prepareData(mixed $data): mixed
    {
        return $data;
    }
}
