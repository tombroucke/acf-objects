<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Contracts\FieldContract;

abstract class Field implements FieldContract
{
    public function __construct(protected mixed $value) {}

    /**
     * @deprecated 3.1.2 Use value() instead.
     */
    public function getValue(): mixed
    {
        trigger_error(
            'Method getValue() is deprecated since version 3.1.2 and will be removed in future versions. Use value() instead.',
            E_USER_DEPRECATED
        );

        return $this->value();
    }

    public function value(): mixed
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
