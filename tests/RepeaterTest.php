<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Otomaties\AcfObjects\Repeater;
use Otomaties\AcfObjects\Repeater\Row;

final class RepeaterTest extends TestCase
{
    private $repeaterArray = [
        ['text' => 'Test 1'],
        ['text' => 'Test 2'],
        ['text' => 'Test 3'],
    ];

    private $repeater;

    protected function setUp() : void
    {
        $this->repeater = new Repeater($this->repeaterArray, null, []);
    }

    public function testRepeaterHasTwoRows()
    {
        $this->assertEquals(3, count($this->repeater));
    }

    public function testRepeaterHasRows()
    {
        $this->assertInstanceOf(Row::class, $this->repeater[0]);
    }

    public function testRepeaterArrayIsReversible()
    {
        $reversedListField = $this->repeater->reverse();
        $this->assertEquals(array_reverse($this->repeaterArray), $reversedListField->value());
    }
}
