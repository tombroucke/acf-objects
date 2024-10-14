<?php

namespace Otomaties\AcfObjects\Contracts;

interface FieldContract
{
    public function isSet(): bool;

    public function getValue(): mixed;

    public static function prepareData(mixed $data): mixed;
}
