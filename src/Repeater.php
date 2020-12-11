<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;
use Otomaties\AcfObjects\Repeater\Row;

class Repeater extends Field implements \ArrayAccess, \Iterator {

	public function offsetExists( $offset ) {
		if ( is_null( $offset ) ) {
			$this->value[] = $value;
		} else {
			$this->value[ $offset ] = $value;
		}
	}

	public function offsetGet( $offset ) {
		return new Row( $this->value[ $offset ] );
	}

	public function offsetSet( $offset, $value ) {
		unset( $this->value[ $offset ] );
	}

	public function offsetUnset( $offset ) {
		return isset( $this->value[ $offset ] ) ? $this->value[ $offset ] : null;
	}


	public function rewind() {
		reset( $this->value );
	}

	public function current() {
		$value = current( $this->value );
		return new Row( $value );
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
		$key   = key( $this->value );
		$value = ( $key !== null && $key !== false );
		return $value;
	}
}
