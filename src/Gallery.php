<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\ListField;

class Gallery extends ListField {

	public function value() {
		if ( is_array( $this->value ) ) {
			return $this->value;
		}
		return array();
	}

	public function offsetGet( $offset ) {
		if ( isset( $this->value[ $offset ] ) ) {
			return new Image( $this->value[ $offset ], $this->post_id, array() );
		}
		return null;
	}

	public function current() {
		$value = current( $this->value );
		return new Image( $value, $this->post_id, array() );
	}

}
