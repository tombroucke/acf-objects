<?php

namespace Otomaties\AcfObjects;

use Illuminate\Support\ServiceProvider;

class AcfObjectsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() : void
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() : void
    {
        add_filter('acf/format_value', function ($value, $postId, $field) {
            $value = Acf::findClassByFieldType($value, $postId, $field);
            return $value;
        }, 99, 3);
    }
}
