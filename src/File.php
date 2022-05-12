<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class File extends Field
{
    public function getId() : ?string
    {
        return isset($this->value['ID']) ? $this->value['ID'] : null;
    }

    public function title() : ?string
    {
        return isset($this->value['title']) ? $this->value['title'] : null;
    }

    public function filename() : ?string
    {
        return isset($this->value['filename']) ? $this->value['filename'] : null;
    }

    public function filesize() : ?string
    {
        return isset($this->value['filesize']) ? $this->value['filesize'] : null;
    }

    /**
     * Get link url
     *
     * @return string
     */
    public function url() : ?string
    {
        return isset($this->value['url']) ? esc_url($this->value['url']) : null;
    }
    public function link() : ?string
    {
        return isset($this->value['link']) ? esc_url($this->value['link']) : null;
    }

    public function alt() : ?string
    {
        return isset($this->value['alt']) ? $this->value['alt'] : null;
    }

    public function author() : ?string
    {
        return isset($this->value['author']) ? $this->value['author'] : null;
    }

    public function description() : ?string
    {
        return isset($this->value['description']) ? $this->value['description'] : null;
    }

    public function caption() : ?string
    {
        return isset($this->value['caption']) ? $this->value['caption'] : null;
    }

    public function name() : ?string
    {
        return isset($this->value['name']) ? $this->value['name'] : null;
    }

    public function status() : ?string
    {
        return isset($this->value['status']) ? $this->value['status'] : null;
    }

    /**
     * @deprecated
     * Get uploaded to
     *
     * @return string|null
     */
    public function uploadedTo() : ?string
    {
        return isset($this->value['uploaded_to']) ? $this->value['uploaded_to'] : null;
    }

    /**
     * @deprecated
     * Get uploaded to
     *
     * @return string|null
     */
    public function uploaded_to() : ?string // phpcs:ignore
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use isEmpty() instead.', E_USER_DEPRECATED);
        return $this->uploadedTo();
    }

    public function date() : ?string
    {
        return isset($this->value['date']) ? $this->value['date'] : null;
    }

    public function modified() : ?string
    {
        return isset($this->value['modified']) ? $this->value['modified'] : null;
    }

    public function menuOrder() : ?string
    {
        return isset($this->value['menu_order']) ? $this->value['menu_order'] : null;
    }

    public function mimeType() : ?string
    {
        return isset($this->value['mime_type']) ? $this->value['mime_type'] : null;
    }

    public function type() : ?string
    {
        return isset($this->value['type']) ? $this->value['type'] : null;
    }

    public function subtype() : ?string
    {
        return isset($this->value['subtype']) ? $this->value['subtype'] : null;
    }

    public function icon() : ?string
    {
        return isset($this->value['icon']) ? $this->value['icon'] : null;
    }

    public function width() : ?string
    {
        return isset($this->value['width']) ? $this->value['width'] : null;
    }

    public function height() : ?string
    {
        return isset($this->value['height']) ? $this->value['height'] : null;
    }

    public function sizes() : ?array
    {
        return isset($this->value['sizes']) ? $this->value['sizes'] : null;
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
