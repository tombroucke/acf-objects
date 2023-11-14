<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;
use Otomaties\AcfObjects\Traits\Attributes;

class Image extends Field
{
    use Attributes;

    /**
     * Image ID
     *
     * @var integer
     */
    private int $id = 0;

    /**
     * Acf return type
     *
     * @var string
     */
    private string $type = '';

   /**
     * Set ACF Field object's value, post ID and field
     *
     * @param mixed $value The field's raw value
     * @param mixed $postId The field's post ID. Zero when field is not for a post
     * @param array<string, mixed> $field The default ACF Field array
     */
    public function __construct(protected mixed $value, protected mixed $postId = 0, protected array $field = [])
    {
        $this->initProperties($value);
    }

    /**
     * Initialize properties
     *
     * @param mixed $value
     * @return void
     */
    private function initProperties(mixed $value) : void
    {
        if (is_int($value)) {
            $this->setId($value);
            $this->type = 'id';
        } elseif (is_array($value) && isset($value['ID']) && is_int($value['ID'])) {
            $this->setId($value['ID']);
            $this->type = 'array';
        } elseif (filter_var($value, FILTER_VALIDATE_URL)) {
            $this->type = 'string';
        } else {
            $this->type = 'undefined';
        }
    }

    /**
     * Set image ID
     *
     * @param integer $id
     * @return void
     */
    private function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get the image ID
     *
     * @return int Return image ID, 0 in case ID is unknown
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set default image
     *
     * @param int|string $default Image ID or url
     * @param string $size WordPress image size name (thumbnail, medium, large, ...)
     * @return self
     */
    public function default($default, string $size = 'thumbnail') : Image
    {
        if ($this->value) {
            return $this;
        }
        if (is_int($default)) {
            $this->value = wp_get_attachment_image_url($default, $size);
        } elseif (is_string($default)) {
            $this->value = $default;
        }
        return $this;
    }

    /**
     * Get image url
     *
     * @param string $size WordPress image size name (thumbnail, medium, large, ...)
     * @return string
     */
    public function url(string $size = 'thumbnail') :? string
    {
        switch ($this->type) {
            case 'id':
            case 'array':
                $url = wp_get_attachment_image_url($this->getId(), $size);
                break;
            case 'string':
                $url = $this->value;
                break;
            default:
                $url = $this->value() ?: null;
        }
        return $url;
    }

    /**
     * Get full image tag
     *
     * @param string $size WordPress image size name (thumbnail, medium, large, ...)
     * @return string
     */
    public function image(string $size = 'thumbnail') :? string
    {
        if ($this->getId() != 0) {
            return wp_get_attachment_image($this->getId(), $size, false, $this->attributes);
        }

        $imageUrl = $this->url();

        if (!$imageUrl) {
            return null;
        }
        return sprintf('<img src="%s"%s />', $imageUrl, $this->attributesString());
    }

    /**
     * Get image alt text
     *
     * @return string
     */
    public function alt() :? string
    {
        if ($this->getId() != 0) {
            return get_post_meta($this->getId(), '_wp_attachment_image_alt', true);
        }
        return null;
    }

    /**
     * Return url if object is echoed
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->url() ?: '';
    }
}
