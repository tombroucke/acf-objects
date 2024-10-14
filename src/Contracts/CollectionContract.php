<?php

namespace Otomaties\AcfObjects\Contracts;

interface CollectionContract
{
    public function isEmpty();

    public function getValue(): mixed;

    public static function prepareData(mixed $data): mixed;
}
