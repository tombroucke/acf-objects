<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Otomaties\AcfObjects\FlexibleContent\Row;
use Otomaties\AcfObjects\Exceptions\InvalidSubFieldException;

final class FlexibleContentRowTest extends TestCase
{
    private $row;

    protected function setUp() : void {
        $row = [
            'acf_fc_layout' => 'custom-layout',
            'key' => 'value'
        ];
        $this->row = new row($row);
    }

    public function testGetValue() {
        $this->assertEquals('value', $this->row->get('key'));
    }

    public function testGetUndefinedValue() {
        $this->expectException(InvalidSubFieldException::class);
        $this->row->get('undefined_key');
    }

    public function testGetLayout() {
        $this->assertEquals('custom-layout', $this->row->layout());
    }
}
