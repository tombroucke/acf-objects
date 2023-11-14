<?php
namespace Otomaties\AcfObjects\Abstracts;

use JsonSerializable;

abstract class Field implements JsonSerializable
{
    /**
     * Set ACF Field object's value, post ID and field
     *
     * @param mixed $value The field's raw value
     * @param mixed $postId The field's post ID. Zero when field is not for a post
     * @param array<string, mixed> $field The default ACF Field array
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
     * Set a default value if field is empty
     *
     * @param mixed $default
     * @return Field
     */
    public function default($default) : Field
    {
        if (!$this->value) {
            $this->value = $default;
        }
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
        return empty($this->value());
    }

    /**
     * Check if field is set
     *
     * @return boolean
     */
    public function isSet() : bool
    {
        return !$this->isEmpty();
    }

    /**
     * Show value if object is echoed
     *
     * @return string
     */
    public function __toString() : string
    {
        return (string)$this->value();
    }

    /**
     * Get fields to serialize
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
