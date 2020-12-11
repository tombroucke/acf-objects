<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Link extends Field {

	private $classes = array();

	public function url() {
		return $this->value['url'];
	}

	public function target() {
        return $this->value['target'];
	}

	public function title() {
		return $this->value['title'];
	}

	public function classes( array $classes ) {
		$this->classes = array_merge( $this->classes, $classes );
		return $this;
	}

	public function link() {
		$target  = ( $this->target() ? sprintf( ' target="%s"', $this->target() ) : '' );
		$classes = ( ! empty( $this->classes ) ? sprintf( ' class="%s"', implode( ' ', $this->classes ) ) : '' );
		return sprintf( '<a href="%s"%s%s>%s</a>', $this->url(), $target, $classes, $this->title() );
	}

	public function __toString() {
		return $this->url();
	}

}
