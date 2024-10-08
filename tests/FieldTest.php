<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

class Field extends Otomaties\AcfObjects\Fields\Field
{
    public function __toString(): string
    {
        return $this->value['url'] ?: '';
    }
}

final class FieldTest extends TestCase
{
    private $value = [
        'title' => 'Hello world!',
        'url' => 'http://development.local/sample-page/',
        'target' => '_blank',
    ];

    private $field;

    private $emptyField;

    protected function setUp(): void
    {
        $this->field = new Field($this->value, 0, []);
        $this->emptyField = new Field(false, 0, []);
    }

    public function testValue()
    {
        $this->assertEquals((string) $this->field, $this->value['url']);
    }

    public function testValueIsCorrect()
    {
        $this->assertTrue($this->field->isSet());
        $this->assertFalse($this->emptyField->isSet());
    }

    public function testDefaultReturnsObject()
    {
        $this->assertIsObject($this->field->default(['title' => 'Title', 'url' => 'https://example.com']));
    }
}
