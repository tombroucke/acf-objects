<?php

namespace Otomaties\AcfObjects\Fields;

class Group extends Collection
{
    public static function prepareData(mixed $data): mixed
    {

        if (is_bool($data) && ! $data) {
            $data = [];
        }

        foreach ($data as $key => $value) {
            if (is_object($value) && method_exists($value, 'isSet') && ! $value->isSet()) {
                unset($data[$key]);
            }
        }

        if (! is_array($data)) {
            $data = array_filter([$data]);
        }

        return $data;
    }
}
