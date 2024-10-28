<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Contracts\CollectionContract;

class Group extends Collection
{
    public function default(mixed $values): CollectionContract
    {
        if ($this->isEmpty()) {
            $this->items = $values;
        } else {
            foreach ($values as $key => $value) {
                if (! isset($this->items[$key])) {
                    $this->items[$key] = $value;
                }
            }
        }

        return $this;
    }

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
