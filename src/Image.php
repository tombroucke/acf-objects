<?php

namespace App\AcfObjects;

class Image {

	protected $ID;
	private $default = false;

	public function __construct( $image ) {

		if ( is_int( $image ) ) {
			$this->ID = $image;
		} else if ( is_array( $image ) ) {
			$this->ID = $image['ID'];
		}

	}

	public function get_ID() {

		return $this->ID;

	}

	public function default() {

		return $this->default;

	}

	public function set_default( string $url ) {

		$this->default = esc_url( $url );

	}

	public function image( string $size = 'thumbnail' ) {

		return wp_get_attachment_image( $this->get_ID(), $size );

	}

	public function url( string $size = 'thumbnail' ) {

		$url = wp_get_attachment_image_url( $this->get_ID(), $size );
		if ( ! $url ) {
			$url = $this->default();
		}
		return $url;

	}
}
