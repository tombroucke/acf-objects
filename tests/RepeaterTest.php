<?php

declare(strict_types=1);
use Otomaties\AcfObjects\Fields\Repeater;
use PHPUnit\Framework\TestCase;

final class RepeaterTest extends TestCase
{
    private $repeaterArray = [
        ['text' => 'Test 1'],
        ['text' => 'Test 2'],
        ['text' => 'Test 3'],
    ];

    private $repeater;

    protected function setUp(): void
    {
        $this->repeater = new Repeater($this->repeaterArray, null, []);
    }

    public function test_repeater_has_two_rows()
    {
        $this->assertEquals(3, count($this->repeater));
    }
}
