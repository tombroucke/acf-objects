<?php

namespace Otomaties\AcfObjects\Contracts;

interface FieldContract
{
    public function isSet(): bool;

    public static function prepareData(mixed $data): mixed;
}
