<?php

namespace Otomaties\AcfObjects\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Otomaties\AcfObjects\AcfObjects;
use Otomaties\AcfObjects\Fields\DatePicker;
use Otomaties\AcfObjects\Fields\DateTimePicker;
use Otomaties\AcfObjects\Fields\FallbackField;

class AcfObjectsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('acf-objects', function () {
            return new AcfObjects;
        });

        /**
         * @param  string  $className
         * @param  mixed  $value
         * @param  array  $field
         * @return mixed
         */
        $this->app->bind('acf-objects.field', function ($app, $parameters) {
            extract($parameters);

            if (! class_exists($className)) {
                $className = FallbackField::class;
            }

            $value = $className::prepareData($value);
            $datePickerFields = [
                DatePicker::class,
                DateTimePicker::class,
            ];

            if (in_array($className, $datePickerFields)) {
                if (empty($value)) {
                    return new FallbackField($value);
                }

                if ($className === DateTimePicker::class) {
                    return DateTimePicker::createFromFormat($field['display_format'], $value);
                }

                return DatePicker::createFromFormat($field['display_format'], $value)->startOfDay();
            }

            return new $className($value);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'acf-objects',
        );

        add_filter('acf/format_value', function ($value, $postId, $field) {
            if (($field['return_object'] ?? false) === false) {
                return $value;
            }

            $excludeTypes = ['true_false'];
            if (in_array($field['type'], $excludeTypes)) {
                return $value;
            }

            $fieldType = $field['type'] ?? 'FallbackField';
            $className = 'Otomaties\AcfObjects\Fields\\'.Str::studly($fieldType);

            return app()->make('acf-objects.field', compact('className', 'value', 'field'));
        }, 99, 3);
    }
}
