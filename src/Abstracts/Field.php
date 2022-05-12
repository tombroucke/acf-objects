<?php
namespace Otomaties\AcfObjects\Abstracts;

abstract class Field
{
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
     * @param mixed $postId The field's post ID. Zero when field is not for a post
     * @param array $field The default ACF Field array
     */
    public function __construct(protected mixed $value, protected mixed $postId = 0, protected array $field = [])
    {
    }

    /**
     * Get the raw valie
     *
     * @return mixed
     */
    public function value() : mixed
    {
        return $this->value;
    }

    /**
     * Set a default value
     *
     * @param mixed $default
     * @return Field
     */
    public function default($default) : Field
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @deprecated
     * Check if field is empty
     *
     * @return boolean
     */
    public function empty() : bool
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use isEmpty() instead.', E_USER_DEPRECATED);
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
