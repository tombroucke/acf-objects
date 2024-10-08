<?php

declare(strict_types=1);
use Otomaties\AcfObjects\Fields\DatePicker;
use PHPUnit\Framework\TestCase;

final class DatePickerTest extends TestCase
{
    private $field = [
        'ID' => 223,
        'key' => 'field_63566ae26c0c8',
        'label' => 'Date',
        'name' => 'date',
        'aria-label' => '',
        'prefix' => 'acf',
        'type' => 'date_picker',
        'value' => '29/10/2022',
        'menu_order' => 0,
        'instructions' => '',
        'required' => 0,
        'id' => '',
        'class' => '',
        'conditional_logic' => 0,
        'parent' => 222,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'display_format' => 'd/m/Y',
        'return_format' => 'd/m/Y',
        'first_day' => 1,
        '_name' => 'date',
        '_valid' => 1,
    ];

    private $datePicker;

    protected function setUp(): void
    {
        $this->datePicker = DatePicker::createFromFormat('d/m/Y', '29/10/2022');
    }

    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            DatePicker::class,
            $this->datePicker
        );
    }

    public function testDateCanBeFormatted(): void
    {
        $this->assertEquals(
            '2022-10-29',
            $this->datePicker->format('Y-m-d')
        );
    }

    public function testTimeStampsCanBeReturned(): void
    {
        $this->assertIsInt(
            $this->datePicker->getTimestamp()
        );
    }
}
