<?php //phpcs:ignore
namespace Otomaties\AcfObjects\Traits;

Trait Attributes {

    protected $attributes = array();

	public function attributes( array $attributes ) {
		foreach ( $attributes as $key => $value ) {
			$this->attributes[ $key ] = $value;
        }
		return $this;
	}

}
