<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Otomaties\AcfObjects\FlexibleContent;
use Otomaties\AcfObjects\FlexibleContent\Row;

final class FlexibleContentTest extends TestCase
{
    private $flexibleContentArray = [
        [
            'acf_fc_layout' => 'text_layout',
            'text' => 'test',
        ],
        [
            'acf_fc_layout' => 'text_layout_2',
            'text' => 'test',
        ]
    ];

    private $flexibleContent;

    protected function setUp() : void {
        $this->flexibleContent = new FlexibleContent($this->flexibleContentArray, null, []);
    }

    public function testFlexibleContentHasTwoRows() {
        $this->assertEquals(2, count($this->flexibleContent));
    }

    public function testFlexibleContentHasRows() {
        $this->assertInstanceOf(Row::class, $this->flexibleContent[0]);
    }
}
