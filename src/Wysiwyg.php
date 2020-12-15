<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Wysiwyg extends Field {

	public function __toString() {
		if ( ! $this->value() ) {
			return $this->default;
		}
		return $this->value();
	}

}
