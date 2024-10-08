<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Traits\Attributes;
use Otomaties\AcfObjects\Traits\FetchesArrayValues;

/**
 * Class Link
 *
 * @method string target() Gets the target attribute of the link
 * @method string title() Gets the title attribute of the link
 * @method string url() Gets the URL of the link
 */
class Link extends Field
{
    use Attributes;
    use FetchesArrayValues;

    /**
     * Compose full a tag
     */
    public function link(): ?string
    {
        if (! $this->value) {
            return null;
        }
        if ($this->target()) {
            $this->attributes(['target' => $this->target()]);
        }

        return view('acf-objects::link', ['url' => $this->url(), 'attributesString' => $this->attributesString(), 'title' => $this->title()])->toHtml();
    }

    /**
     * Return url if object is echoed
     */
    public function __toString(): string
    {
        return $this->url() ?: '';
    }
}
