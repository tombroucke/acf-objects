<?php

namespace App\AcfObjects;

class Group {

	protected $group;

	public function __construct( array $group ) {

		$this->group = $group;

	}

	public function get( string $param ) {

		return $this->group[ $param ];

	}
}
