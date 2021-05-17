<?php
namespace Otomaties\AcfObjects\Abstracts;

abstract class Field
{
    /**
     * The field's raw value
     *
     * @var mixed
     */
    protected $value;

    /**
     * The field's post ID. Zero when field is not for a post
     *
     * @var integer
     */
    protected $post_id = 0;

    /**
     * The default ACF Field array
     *
     * @var array
     */
    protected $field   = array();

    /**
     * The default value for this field
     *
     * @var string|array
     */
    protected $default = '';

    /**
     * Set ACF Field object's value, post ID and field
     *
     * @param mixed $value The field's raw value
     * @param integer $post_id The field's post ID. Zero when field is not for a post
     * @param array $field The default ACF Field array
     */
    public function __construct($value, $post_id = 0, array $field = array())
    {
        $this->value   = $value;
        $this->post_id = $post_id;
        $this->field   = $field;
    }

    /**
     * Get the raw valie
     *
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Set a default value
     *
     * @param mixed $default
     * @return self
     */
    public function default($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * Check if field is empty
     *
     * @return boolean
     */
    public function empty()
    {
        return empty($this->value);
    }

    /**
     * Check if field is not emptu
     *
     * @return boolean
     */
    public function isset()
    {
        return ! empty($this->value);
    }

    /**
     * Show value if object is echoed
     *
     * @return string
     */
    public function __toString()
    {
        if (! $this->value()) {
            return $this->default;
        }
        return $this->value();
    }
}
