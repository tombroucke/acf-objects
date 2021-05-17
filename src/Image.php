<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;
use Otomaties\AcfObjects\Traits\Attributes;

class Image extends Field
{
    use Attributes;

    /**
     * The image URL
     *
     * @var string|null
     */
    private $url = null;

    /**
     * Set ACF Field object's value, post ID and field
     * Save url if ACF return value is set to URL
     *
     * @param [type] $value
     * @param integer $post_id
     * @param array $field
     */
    public function __construct($value, $post_id = 0, array $field = array())
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $this->url = $value;
        }
        parent::__construct($value, $post_id, $field);
    }

    /**
     * Get the image ID
     *
     * @return int Zero in case ID is unknown
     */
    public function get_ID()
    {
        // Only in case an ID or array is returned.
        if (is_numeric($this->value)) {
            return $this->value;
        } elseif (isset($this->value['ID'])) {
            return $this->value['ID'];
        }
        return 0;
    }

    /**
     * Set default image
     *
     * @param int|string $default Image ID or url
     * @param string $size WordPress image size name (thumbnail, medium, large, ...)
     * @return self
     */
    public function default($default, string $size = 'thumbnail')
    {
        if (is_int($default)) {
            $this->default = wp_get_attachment_image_url($default, $size);
        } elseif (is_string($default)) {
            $this->default = $default;
        }
        return $this;
    }

    /**
     * Get image url
     *
     * @param string $size WordPress image size name (thumbnail, medium, large, ...)
     * @return string
     */
    public function url(string $size = 'thumbnail')
    {

        if ($this->get_ID() != 0) {
            return wp_get_attachment_image_url($this->get_ID(), $size);
        } elseif (isset($this->url)) {
            return $this->url;
        }
        return $this->default;
    }

    /**
     * Get full image tag
     *
     * @param string $size WordPress image size name (thumbnail, medium, large, ...)
     * @return string
     */
    public function image(string $size = 'thumbnail')
    {
        if ($this->get_ID() != 0) {
            return wp_get_attachment_image($this->get_ID(), $size, null, $this->attributes);
        } elseif (isset($this->url)) {
            return sprintf('<img src="%s" />', $this->url);
        } elseif ($this->default) {
            return sprintf('<img src="%s" />', $this->default);
        }
    }

    /**
     * Return url if object is echoed
     *
     * @return string
     */
    public function __toString()
    {
        return $this->url();
    }
}
