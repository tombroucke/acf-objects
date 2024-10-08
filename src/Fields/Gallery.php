<?php

namespace Otomaties\AcfObjects\Fields;

class Gallery extends Collection
{
    public static function prepareData(mixed $data): mixed
    {
        return collect(parent::prepareData($data))
            ->map(function ($item) {
                return new Image($item);
            });
    }
}
