<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;
use Otomaties\AcfObjects\Traits\Attributes;

class Link extends Field {

    use Attributes;

	public function url() {
		return isset( $this->value['url'] ) ? $this->value['url'] : '';
	}

	public function target() {
		return isset( $this->value['target'] ) ? $this->value['target'] : '';
	}

	public function title() {
		return isset( $this->value['title'] ) ? $this->value['title'] : '';
	}

	public function link() {
		if ( ! $this->value ) {
			return '';
		}
		$target     = ( $this->target() ? sprintf( ' target="%s"', $this->target() ) : '' );
		$attributes = '';
		if ( ! empty( $this->attributes ) ) {
			foreach ( $this->attributes as $key => $value ) {
				$attributes .= ' ' . $key . '="' . $value . '"';
			}
		}
		return sprintf( '<a href="%s"%s%s>%s</a>', $this->url(), $target, $attributes, $this->title() );
	}

	public function __toString() {
		return $this->url();
	}

}
