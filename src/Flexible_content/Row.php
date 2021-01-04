<?php //phpcs:ignore
namespace Otomaties\AcfObjects\Flexible_content;

class Row {

	protected $row;

	public function __construct( array $row = array() ) {
		$this->row = $row;
	}

	public function get( $key ) {
		return $this->row[ $key ];
    }

    public function layout() {
        return $this->get('acf_fc_layout');
    }

}
