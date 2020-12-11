<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Link extends Field {

	private $classes    = array();
	private $attributes = array();

	public function url() {
		return isset( $this->value['url'] ) ? $this->value['url'] : '';
	}

	public function target() {
		return isset( $this->value['target'] ) ? $this->value['target'] : '';
	}

	public function title() {
		return isset( $this->value['title'] ) ? $this->value['title'] : '';
	}

	public function classes( array $classes ) {
		$this->classes = array_merge( $this->classes, $classes );
		return $this;
	}

	public function attributes( array $attributes ) {
		foreach ( $attributes as $key => $value ) {
			$this->attributes[ $key ] = $value;
		}
		return $this;
	}

	public function link() {
		if ( ! $this->value ) {
			return '';
		}
		$target     = ( $this->target() ? sprintf( ' target="%s"', $this->target() ) : '' );
		$classes    = ( ! empty( $this->classes ) ? sprintf( ' class="%s"', implode( ' ', $this->classes ) ) : '' );
		$attributes = '';
		if ( ! empty( $this->attributes ) ) {
			foreach ( $this->attributes as $key => $value ) {
				$attributes .= ' ' . $key . '=' . $value;
			}
		}
		return sprintf( '<a href="%s"%s%s%s>%s</a>', $this->url(), $target, $classes, $attributes, $this->title() );
	}

	public function __toString() {
		return $this->url();
	}

}
