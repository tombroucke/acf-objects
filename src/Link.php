<?php

namespace App\AcfObjects;

class Link {

	private $url = '';
	private $target = '';
	private $title = '';

	public function __construct( $link ) {

		if ( is_string( $link ) ) {
			$this->url = $link;
		} else if ( is_array( $link ) ) {
			$this->url = $link['url'];
			$this->target = $link['target'];
			$this->title = $link['title'];
		}

	}

	public function url() {

		return $this->url;

	}

	public function target() {

		return $this->target;

	}

	public function title() {

		return $this->title;

	}

	public function set( string $param, string $value ) {

		$this->$param = $value;

	}
}
