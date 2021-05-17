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
    public function url()
    {
        return isset($this->value['url']) ? $this->value['url'] : '';
    }

    /**
     * Get link target
     *
     * @return string
     */
    public function target()
    {
        return isset($this->value['target']) ? $this->value['target'] : '';
    }

    /**
     * Get link title
     *
     * @return string
     */
    public function title()
    {
        return isset($this->value['title']) ? $this->value['title'] : '';
    }

    /**
     * Get full a tag
     *
     * @return string
     */
    public function link()
    {
        if (! $this->value) {
            return '';
        }
        $target     = ( $this->target() ? sprintf(' target="%s"', $this->target()) : '' );
        $attributes = '';
        if (! empty($this->attributes)) {
            foreach ($this->attributes as $key => $value) {
                $attributes .= ' ' . $key . '="' . $value . '"';
            }
        }
        return sprintf('<a href="%s"%s%s>%s</a>', $this->url(), $target, $attributes, $this->title());
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
