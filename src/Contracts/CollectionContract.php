<?php

namespace Otomaties\AcfObjects\Contracts;

interface CollectionContract
{
    public function isEmpty();

    public static function prepareData(mixed $data): mixed;
}
