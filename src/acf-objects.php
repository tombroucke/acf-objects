<?php

if ( function_exists( 'add_filter' ) ) {

	add_filter(
		'acf/format_value',
		function( $value, $post_id, $field ) {
			switch ( $field['type'] ) {
				case 'group':
					return new \App\AcfObjects\Group( $value );
				break;
				case 'image':
					return new \App\AcfObjects\Image( $value );
				break;
				case 'link':
					return new \App\AcfObjects\Link( $value );
				break;
				case 'repeater':
					return new \App\AcfObjects\Repeater( array_filter( (array) $value ) );
				break;
			}
			return $value;
		},
		9999,
		3
	);

}
