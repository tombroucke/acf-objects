<?php

declare(strict_types=1);
use Otomaties\AcfObjects\Fields\GoogleMap;
use PHPUnit\Framework\TestCase;

final class GoogleMapTest extends TestCase
{
    private $googleMapArray = [
        'address' => 'Em. Zolastraat, Menen, Belgium',
        'lat' => 50.80698,
        'lng' => 3.1082768,
        'zoom' => 14,
        'place_id' => 'EiNFbS4gWm9sYXN0cmFhdCwgODkzMCBNZW5lbiwgQmVsZ2l1bSIuKiwKFAoSCYcvW7IHMsNHEYKU8WvGoIPBEhQKEgl5qof-_S3DRxGtBVArtTNrcA',
        'name' => 'Em. Zolastraat',
        'street_name' => 'Em. Zolastraat',
        'city' => 'Menen',
        'state' => 'Vlaams Gewest',
        'state_short' => 'WV',
        'post_code' => '8930',
        'country' => 'Belgium',
        'country_short' => 'BE',
    ];

    private $googleMap;

    private $emptyGoogleMap;

    protected function setUp(): void
    {
        $this->googleMap = new GoogleMap($this->googleMapArray, null, []);
        $this->emptyGoogleMap = new GoogleMap([], null, []);
    }

    public function test_address()
    {
        $this->assertEquals('Em. Zolastraat, Menen, Belgium', $this->googleMap->address());
        $this->assertNull($this->emptyGoogleMap->address());
        $this->assertEquals('Em. Zolastraat, Menen, Belgium', $this->emptyGoogleMap->default(['address' => 'Em. Zolastraat, Menen, Belgium'])->address());
    }

    public function test_lat()
    {
        $this->assertEquals(50.80698, $this->googleMap->lat());
        $this->assertNull($this->emptyGoogleMap->lat());
        $this->assertEquals(50.80698, $this->googleMap->default(['lat' => 50.80698])->lat());
    }

    public function test_lng()
    {
        $this->assertEquals(3.1082768, $this->googleMap->lng());
        $this->assertNull($this->emptyGoogleMap->lng());
        $this->assertEquals(3.1082768, $this->googleMap->default(['lng' => 3.1082768])->lng());
    }

    public function test_zoom()
    {
        $this->assertEquals(14, $this->googleMap->zoom());
        $this->assertNull($this->emptyGoogleMap->zoom());
        $this->assertEquals(14, $this->googleMap->default(['zoom' => 14])->zoom());
    }

    public function test_name()
    {
        $this->assertEquals('Em. Zolastraat', $this->googleMap->name());
        $this->assertNull($this->emptyGoogleMap->name());
        $this->assertEquals('Em. Zolastraat', $this->googleMap->default(['name' => 'Em. Zolastraat'])->name());
    }

    public function test_street_name()
    {
        $this->assertEquals('Em. Zolastraat', $this->googleMap->StreetName());
        $this->assertNull($this->emptyGoogleMap->StreetName());
        $this->assertEquals('Em. Zolastraat', $this->googleMap->default(['StreetName' => 'Em. Zolastraat'])->StreetName());
    }

    public function test_city()
    {
        $this->assertEquals('Menen', $this->googleMap->city());
        $this->assertNull($this->emptyGoogleMap->city());
        $this->assertEquals('Menen', $this->googleMap->default(['city' => 'Menen'])->city());
    }

    public function test_state()
    {
        $this->assertEquals('Vlaams Gewest', $this->googleMap->state());
        $this->assertNull($this->emptyGoogleMap->state());
        $this->assertEquals('Vlaams Gewest', $this->googleMap->default(['state' => 'Vlaams Gewest'])->state());
    }

    public function test_state_short()
    {
        $this->assertEquals('WV', $this->googleMap->stateShort());
        $this->assertNull($this->emptyGoogleMap->stateShort());
        $this->assertEquals('WV', $this->googleMap->default(['stateShort' => 'WV'])->stateShort());
    }

    public function test_post_code()
    {
        $this->assertEquals('8930', $this->googleMap->postCode());
        $this->assertNull($this->emptyGoogleMap->postCode());
        $this->assertEquals('8930', $this->googleMap->default(['postcode' => '8930'])->postCode());
    }

    public function test_country()
    {
        $this->assertEquals('Belgium', $this->googleMap->country());
        $this->assertNull($this->emptyGoogleMap->country());
        $this->assertEquals('Belgium', $this->googleMap->default(['country' => 'Belgium'])->country());
    }

    public function test_country_short()
    {
        $this->assertEquals('BE', $this->googleMap->countryShort());
        $this->assertNull($this->emptyGoogleMap->countryShort());
        $this->assertEquals('BE', $this->googleMap->default(['countryShort' => 'BE'])->countryShort());
    }
}
