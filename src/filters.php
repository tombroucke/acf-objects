<?php
use Otomaties\AcfObjects\Acf;

if (! function_exists('add_filter')) {
    return;
}

add_filter('acf/format_value', function ($value, $post_id, $field) {
    // if($field['type'] == 'image') {
    //     dd($field);
    // }
    $value = Acf::findClassByFieldType($value, $post_id, $field);
    return $value;
}, 99, 3);
