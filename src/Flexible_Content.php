<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\ListField;
use Otomaties\AcfObjects\Flexible_content\Row;

class Flexible_content extends ListField {

	public function value() {
		if ( is_array( $this->value ) ) {
			return $this->value;
		}
		return array();
	}

	public function offsetGet( $offset ) {
		if ( isset( $this->value[ $offset ] ) ) {
			return new Row( $this->value[ $offset ] );
		}
		return null;
	}

	public function current() {
		$value = current( $this->value );
		return new Row( $value );
	}
}
