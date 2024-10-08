<?php

namespace Otomaties\AcfObjects\Fields;

use Illuminate\Support\Collection as SupportCollection;
use Otomaties\AcfObjects\Contracts\CollectionContract;

abstract class Collection extends SupportCollection implements CollectionContract
{
    public function default(mixed $value): CollectionContract
    {
        if ($this->isEmpty()) {
            $this->items = $value;
        }

        return $this;

    }

    public static function prepareData(mixed $data): mixed
    {
        if (
            (is_array($data) && ! array_is_list($data))
            || ! is_array($data)
        ) {
            $data = [$data];
        }

        return array_filter($data);
    }
}
