<?php

namespace App\AcfObjects;

class Row {

	protected $row_array;

	public function __construct( array $row_array ) {

		$this->row_array = $row_array;

	}

	public function get( $index ) {

		return isset( $this->row_array[ $index ] ) ? $this->row_array[ $index ] : false;

	}
}
