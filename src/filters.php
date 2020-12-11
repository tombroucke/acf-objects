<?php //phpcs:ignore

if ( ! function_exists( 'add_filter' ) ) {
	return;
}

add_filter(
	'acf/format_value',
	function( $value, $post_id, $field ) {
		$class = '\\Otomaties\\AcfObjects\\' . ucfirst( $field['type'] );
		if ( class_exists( $class ) ) {
			$value = new $class( $value, $post_id, $field );
		}
		return $value;
	},
	99999999,
	3
);
