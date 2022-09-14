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
    private ?string $originalUrl = null;

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
     * @param array $field The default ACF Field array
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
        if (is_numeric($value)) {
            $this->setId($value);
            $this->type = 'id';
        } elseif (is_array($value) && isset($value['ID']) && is_numeric($value['ID'])) {
            $this->setId($value['ID']);
            $this->type = 'array';
        } elseif (filter_var($value, FILTER_VALIDATE_URL)) {
            $this->originalUrl = $value;
            $this->type = 'external';
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
    public function url(string $size = 'thumbnail') :? string
    {
        $url = null;
        if ($this->type == 'external') {
            $url = $this->originalUrl;
        } elseif ($this->getId() != 0) {
            $url = wp_get_attachment_image_url($this->getId(), $size);
        } elseif ($this->default) {
            $url = $this->default;
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
            return wp_get_attachment_image($this->getId(), $size, null, $this->attributes);
        }

        $imageUrl = $this->url();

        if (!$imageUrl) {
            return null;
        }
        return sprintf('<img src="%s"%s />', $imageUrl, $this->attributesString());
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
