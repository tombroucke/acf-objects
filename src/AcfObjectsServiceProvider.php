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
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        add_filter('acf/format_value', function ($value, $post_id, $field) {
            $value = Acf::findClassByFieldType($value, $post_id, $field);
            return $value;
        }, 99, 3);
    }
}
