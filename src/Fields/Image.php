<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Traits\Attributes;

class Image extends Field
{
    use Attributes;

    private function type(): string
    {
        if (is_int($this->value)) {
            return 'id';
        } elseif (is_array($this->value) && isset($this->value['ID']) && is_int($this->value['ID'])) {
            return 'array';
        } elseif (filter_var($this->value, FILTER_VALIDATE_URL)) {
            return 'string';
        }

        return 'undefined';
    }

    /**
     * Get the image ID
     *
     * @return int Return image ID, 0 in case ID is unknown
     */
    public function getId(): int
    {
        if (is_int($this->value)) {
            return $this->value;
        } elseif (is_array($this->value) && isset($this->value['ID']) && is_int($this->value['ID'])) {
            return $this->value['ID'];
        }

        return 0;
    }

    /**
     * Get image url
     *
     * @param  string  $size  WordPress image size name (thumbnail, medium, large, ...)
     */
    public function url(string $size = 'thumbnail'): ?string
    {
        switch ($this->type()) {
            case 'id':
            case 'array':
                return wp_get_attachment_image_url($this->getId(), $size) ?: null;
            case 'string':
                return $this->value;
        }

        return null;
    }

    /**
     * Get full image tag
     *
     * @param  string  $size  WordPress image size name (thumbnail, medium, large, ...)
     */
    public function image(string $size = 'thumbnail'): ?string
    {
        if ($this->getId() != 0) {
            return wp_get_attachment_image($this->getId(), $size, false, $this->attributes);
        }

        $imageUrl = $this->url();

        if (! $imageUrl) {
            return null;
        }

        return view('acf-objects::image', [
            'url' => $imageUrl,
            'attributesString' => $this->attributesString(),
        ])->toHtml();
    }

    /**
     * Get image alt text
     */
    public function alt(): ?string
    {
        if ($this->getId() != 0) {
            return get_post_meta($this->getId(), '_wp_attachment_image_alt', true);
        }

        return null;
    }

    /**
     * Return url if object is echoed
     */
    public function __toString(): string
    {
        return $this->url() ?: '';
    }
}
