<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Image extends Field {

	public function get_ID() {
        if( ! isset( $this->value['ID'] ) ) {
            return 0;
        }
		return $this->value['ID'];
	}

	public function __toString() {
		return $this->url();
    }

    public function default( $default, string $size = 'thumbnail' ) {
        if( is_int( $default ) ) {
            $this->default = wp_get_attachment_image_url( $default, $size );
        } elseif( is_string( $default ) ) {
            $this->default = $default;
        }
        return $this;
    }

	public function url( string $size = 'thumbnail' ) {

        if( $this->get_ID() != 0 ) {
            return wp_get_attachment_image_url( $this->get_ID(), $size );
        }
        return $this->default;

    }

	public function image( string $size = 'thumbnail' ) {
        if( $this->get_ID() != 0 ) {
            return wp_get_attachment_image( $this->get_ID(), $size );
        }

        return sprintf( '<img src="%s" />', $this->default );
	}

}
