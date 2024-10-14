<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Contracts\FieldContract;

abstract class Field implements FieldContract
{
    public function __construct(protected mixed $value) {}

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function isSet(): bool
    {
        return isset($this->value) && ! empty($this->value);
    }

    public function default(mixed $value): FieldContract
    {
        if (! $this->isSet()) {
            $this->value = $value;
        }

        return $this;

    }

    public static function prepareData(mixed $data): mixed
    {
        return $data;
    }
}
