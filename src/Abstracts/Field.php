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
    protected $field = [];

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
    public function __construct($value, $post_id = 0, array $field = [])
    {
        $this->value = $value;
        $this->post_id = $post_id;
        $this->field = $field;
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
    public function default($default) : self
    {
        $this->default = $default;
        return $this;
    }

    /**
     * Check if field is empty
     *
     * @return boolean
     */
    public function empty() : bool
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use empty() instead.', E_USER_DEPRECATED);
        return $this->isEmpty();
    }

    /**
     * Check if field is empty
     *
     * @return boolean
     */
    public function isEmpty() : bool
    {
        return empty($this->value);
    }

    /**
     * Check if field is set
     *
     * @return boolean
     */
    public function isSet() : bool
    {
        return ! $this->isEmpty();
    }

    /**
     * Show value if object is echoed
     *
     * @return string
     */
    public function __toString() : string
    {
        if (! $this->value()) {
            return $this->default;
        }
        return $this->value();
    }
}
