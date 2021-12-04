<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Otomaties\AcfObjects\Repeater\Row;

final class RepeaterRowTest extends TestCase
{
    private $row;

    protected function setUp() : void {
        $row = [
            'key' => 'value'
        ];
        $this->row = new row($row);
    }

    public function testGetValue() {
        $this->assertEquals('value', $this->row->get('key'));
        $this->assertNull($this->row->get('undefined_key'));
    }
}
