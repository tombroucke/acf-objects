<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Gallery extends Field implements \ArrayAccess, \Iterator {

	public function images() {
		return array_map(
			function( $image_array ) {
				return new Image( $image_array, $this->post_id, array() );
			},
			$this->value
		);
	}

	public function value() {
		if ( is_array( $this->value ) ) {
			return $this->value;
		}
		return array();
	}

	public function offsetExists( $offset ) {
		if ( is_null( $offset ) ) {
			$this->value[] = $value;
		} else {
			$this->value[ $offset ] = $value;
		}
	}

	public function offsetGet( $offset ) {
		$image = ( isset( $this->value[ $offset ] ) ? $this->value[ $offset ] : 0 );
		return new Image( $image, $this->post_id, array() );
	}

	public function offsetSet( $offset, $value ) {
		unset( $this->value[ $offset ] );
	}

	public function offsetUnset( $offset ) {
		return isset( $this->value[ $offset ] ) ? $this->value[ $offset ] : null;
	}


	public function rewind() {
		if ( ! empty( $this->value() ) ) {
			reset( $this->value );
		}
	}

	public function current() {
		$value = current( $this->value );
		return new Image( $value, $this->post_id, array() );
	}

	public function key() {
		$value = key( $this->value );
		return $value;
	}

	public function next() {
		$value = next( $this->value );
		return $value;
	}

	public function valid() {
		$value = null;
		if ( ! empty( $this->value() ) ) {
			$key   = key( $this->value );
			$value = ( $key !== null && $key !== false );
		}
		return $value;
	}

}
