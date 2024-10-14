<?php

namespace Otomaties\AcfObjects\Traits;

use Illuminate\Support\Str;

trait FetchesArrayValues
{
    public function __call(string $name, mixed $arguments): mixed
    {
        $snakeName = Str::snake($name);

        if (! $this->value) {
            return null;
        }

        if (array_key_exists($snakeName, $this->value)) {
            return $this->value[$snakeName];
        }

        throw new \Exception("Field $name does not exist");
    }
}
