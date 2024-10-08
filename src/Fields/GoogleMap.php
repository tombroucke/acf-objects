<?php

namespace Otomaties\AcfObjects\Fields;

use Otomaties\AcfObjects\Traits\FetchesArrayValues;

/**
 * Class GoogleMap
 *
 * @method string address() Gets the address of the Google Map
 * @method float lat() Gets the latitude of the Google Map
 * @method float lng() Gets the longitude of the Google Map
 * @method int zoom() Gets the zoom level of the Google Map
 * @method string placeId() Gets the place ID of the Google Map
 * @method string name() Gets the name of the Google Map
 * @method string streetNumber() Gets the street number of the Google Map
 * @method string streetName() Gets the street name of the Google Map
 * @method string city() Gets the city of the Google Map
 * @method string state() Gets the state of the Google Map
 * @method string stateShort() Gets the short state of the Google Map
 * @method string postCode() Gets the post code of the Google Map
 * @method string country() Gets the country of the Google Map
 * @method string countryShort() Gets the short country of the Google Map
 */
class GoogleMap extends Field
{
    use FetchesArrayValues;

    public function __toString(): string
    {
        return $this->address() ?: '';
    }
}
