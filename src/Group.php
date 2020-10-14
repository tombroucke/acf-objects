<?php

namespace App\AcfObjects;

class Group {

	protected $group;

	public function __construct( $group ) {

		$this->group = $group;

	}

	public function get( string $param ) {

        if( isset( $this->group[ $param ] ) ) {
            return $this->group[ $param ];
        }
		return false;

	}
}
