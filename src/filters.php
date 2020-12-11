<?php //phpcs:ignore
namespace Otomaties\ACF_Objects;

\add_filter('acf/format_value', function( $value, $post_id, $field ){
    $class = '\\Otomaties\\ACF_Objects\\' . ucfirst( $field['type'] );
	if ( class_exists( $class ) ) {
		$value = new $class( $value, $post_id, $field );
    }
    return $value;
});
