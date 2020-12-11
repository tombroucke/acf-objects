<?php //phpcs:ignore
namespace Otomaties\ACF_Objects;

use Otomaties\ACF_Objects\Abstracts\Field;

class Text extends Field {

	public function __toString() {
        if( ! $this->value() ) {
            return $this->default;
        }
		return $this->value();
	}

}
