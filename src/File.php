<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;
use Otomaties\AcfObjects\Traits\Attributes;

class File extends Field
{

    use Attributes;

    /**
     * Get link url
     *
     * @return string
     */
    public function url()
    {
        return isset($this->value['url']) ? $this->value['url'] : '';
    }

    public function title() {
        return isset($this->value['title']) ? $this->value['title'] : '';
    }

    public function mimeType() {
        return isset($this->value['mime_type']) ? $this->value['mime_type'] : '';
    }

    public function width() {
        return isset($this->value['width']) ? $this->value['width'] : '';
    }

    public function height() {
        return isset($this->value['height']) ? $this->value['height'] : '';
    }

    public function caption() {
        return isset($this->value['caption']) ? $this->value['caption'] : '';
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
