<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class GoogleMap extends Field
{

    private $lat;
    private $lng;
    private $address;
    private $name;
    private $streetName;
    private $streetNumber;
    private $city;
    private $state;
    private $stateShort;
    private $postcode;
    private $country;
    private $countryShort;
    private $zoom;
    private $defaults = null;

    public function __construct(protected mixed $value, protected mixed $postId = 0, protected array $field = [])
    {
        $this->initProperties($value);
    }

    public function initProperties($value)
    {
        $this->lat = isset($value['lat']) ? $value['lat'] : null;
        $this->lng = isset($value['lng']) ? $value['lng'] : null;
        $this->address = isset($value['address']) ? $value['address'] : null;
        $this->name = isset($value['name']) ? $value['name'] : null;
        $this->streetName = isset($value['street_name']) ? $value['street_name'] : null;
        $this->streetNumber = isset($value['street_number']) ? $value['street_number'] : null;
        $this->city = isset($value['city']) ? $value['city'] : null;
        $this->state = isset($value['state']) ? $value['state'] : null;
        $this->stateShort = isset($value['state_short']) ? $value['state_short'] : null;
        $this->postcode = isset($value['post_code']) ? $value['post_code'] : null;
        $this->country = isset($value['country']) ? $value['country'] : null;
        $this->countryShort = isset($value['country_short']) ? $value['country_short'] : null;
        $this->zoom = isset($value['zoom']) ? $value['zoom'] : null;
    }

    public function default($default) : GoogleMap
    {
        $possibleKeys = [
            'lat',
            'lng',
            'address',
            'name',
            'street_name',
            'street_number',
            'city',
            'state',
            'state_short',
            'postcode',
            'country',
            'country_short',
            'zoom'
        ];
        foreach ($default as $key => $value) {
            if (!in_array($key, $possibleKeys)) {
                unset($default[$key]);
            }
        }
        $this->defaults = $default;
        return $this;
    }

    private function getDefault($key) : mixed
    {
        return isset($this->defaults[$key]) ? $this->defaults[$key] : null;
    }

    public function lat() :? float
    {
        return isset($this->lat) ? $this->lat : $this->getDefault('lat');
    }

    public function lng() :? float
    {
        return isset($this->lng) ? $this->lng : $this->getDefault('lng');
    }

    public function address() :? string
    {
        return isset($this->address) ? $this->address : $this->getDefault('address');
    }

    public function name() :? string
    {
        return isset($this->name) ? $this->name : $this->getDefault('name');
    }

    public function streetName() :? string
    {
        return isset($this->streetName) ? $this->streetName : $this->getDefault('street_name');
    }

    public function streetNumber() :? string
    {
        return isset($this->streetNumber) ? $this->streetNumber : $this->getDefault('street_number');
    }

    public function city() :? string
    {
        return isset($this->city) ? $this->city : $this->getDefault('city');
    }

    public function state() :? string
    {
        return isset($this->state) ? $this->state : $this->getDefault('state');
    }

    public function stateShort() :? string
    {
        return isset($this->stateShort) ? $this->stateShort : $this->getDefault('state_short');
    }

    public function postcode() :? string
    {
        return isset($this->postcode) ? $this->postcode : $this->getDefault('post_code');
    }

    public function country() :? string
    {
        return isset($this->country) ? $this->country : $this->getDefault('country');
    }

    public function countryShort() :? string
    {
        return isset($this->countryShort) ? $this->countryShort : $this->getDefault('country_short');
    }

    public function zoom() :? int
    {
        return isset($this->zoom) ? $this->zoom : $this->getDefault('zoom');
    }

    public function __toString(): string
    {
        return $this->address() ?: '';
    }
}
