<?php

namespace Otomaties\AcfObjects\Fields;

class Taxonomy extends Collection
{
    public static function prepareData(mixed $data): mixed
    {
        return collect(parent::prepareData($data))
            ->map(function ($item) {
                if (is_int($item)) {
                    return get_term($item);
                }

                return $item;
            })
            ->toArray();
    }
}
