<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;
use Otomaties\AcfObjects\Traits\Attributes;

class Link extends Field
{

    use Attributes;

    /**
     * Get link url
     *
     * @return string
     */
    public function url() : ?string
    {
        return isset($this->value['url']) ? $this->value['url'] : null;
    }

    /**
     * Get link target
     *
     * @return string|null
     */
    public function target() : ?string
    {
        return isset($this->value['target']) ? $this->value['target'] : null;
    }

    /**
     * Get link title
     *
     * @return string
     */
    public function title() : ?string
    {
        return isset($this->value['title']) ? $this->value['title'] : null;
    }

    /**
     * Compose full a tag
     *
     * @return string|null
     */
    public function link() : ?string
    {
        if (! $this->value) {
            return null;
        }
        if ($this->target()) {
            $this->attributes(['target' => $this->target()]);
        }
        return sprintf('<a href="%s"%s>%s</a>', $this->url(), $this->attributesString(), $this->title());
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
