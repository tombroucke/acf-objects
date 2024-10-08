<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Traits\FetchesArrayValues;

/**
 * Class File
 *
 * @method int id() Gets the ID of the file
 * @method string title() Gets the title of the file
 * @method string filename() Gets the filename of the file
 * @method int filesize() Gets the filesize of the file
 * @method string url() Gets the URL of the file
 * @method string link() Gets the link of the file
 * @method string alt() Gets the alt of the file
 * @method int author() Gets the author of the file
 * @method string description() Gets the description of the file
 * @method string caption() Gets the caption of the file
 * @method string name() Gets the name of the file
 * @method string status() Gets the status of the file
 * @method int uploadedTo() Gets the uploaded to of the file
 * @method string date() Gets the date of the file
 * @method string modified() Gets the modified of the file
 * @method int menuOrder() Gets the menu order of the file
 * @method string mimeType() Gets the mime type of the file
 * @method string type() Gets the type of the file
 * @method string subtype() Gets the subtype of the file
 * @method string icon() Gets the icon of the file
 * @method int width() Gets the width of the file
 * @method int height() Gets the height of the file
 * @method array sizes() Gets the sizes of the file
 */
class File extends Field
{
    use FetchesArrayValues;

    /**
     * Return url if object is echoed
     */
    public function __toString(): string
    {
        return $this->url() ?: '';
    }
}
