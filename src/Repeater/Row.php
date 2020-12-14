<?php //phpcs:ignore
namespace Otomaties\AcfObjects\Repeater;

class Row {

	protected $row;

	public function __construct( array $row = array() ) {
		$this->row = $row;
	}

	public function get( $key ) {
		return $this->row[ $key ];
	}

}
