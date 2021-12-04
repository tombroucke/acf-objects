<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class File extends Field
{
    /**
     * Get link url
     *
     * @return string
     */
    public function url() : ?string
    {
        return isset($this->value['url']) ? $this->value['url'] : null;
    }

    public function title() : ?string
    {
        return isset($this->value['title']) ? $this->value['title'] : null;
    }

    public function mimeType() : ?string
    {
        return isset($this->value['mime_type']) ? $this->value['mime_type'] : null;
    }

    public function width() : ?string
    {
        return isset($this->value['width']) ? $this->value['width'] : null;
    }

    public function height() : ?string
    {
        return isset($this->value['height']) ? $this->value['height'] : null;
    }

    public function caption() : ?string
    {
        return isset($this->value['caption']) ? $this->value['caption'] : null;
    }

    /**
     * Return url if object is echoed
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->url();
    }
}
