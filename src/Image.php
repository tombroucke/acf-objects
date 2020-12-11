<?php //phpcs:ignore
namespace Otomaties\AcfObjects;

use App\ACF_Objects\Abstracts\Field;

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

	public function url( string $size = 'thumbnail' ) {

        $url = wp_get_attachment_image_url( $this->get_ID(), $size );
		return $url;

    }

	public function image( string $size = 'thumbnail' ) {

		return wp_get_attachment_image( $this->get_ID(), $size );

	}

}
