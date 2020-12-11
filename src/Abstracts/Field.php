<?php //phpcs:ignore
namespace Otomaties\AcfObjects\Abstracts;

abstract class Field {

	protected $value   = '';
	protected $post_id = 0;
    protected $field   = array();
    protected $default = '';

	public function __construct( $value, int $post_id, array $field ) {
		$this->value   = $value;
		$this->post_id = $post_id;
		$this->field   = $field;
    }

	public function value() {
		return $this->value;
    }

    public function default( $default ) {
        $this->default = $default;
        return $this;
    }
}
