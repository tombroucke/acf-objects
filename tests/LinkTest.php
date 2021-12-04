<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Otomaties\AcfObjects\Link;

final class LinkTest extends TestCase
{
    private $linkArray = [
        'title' => 'Hello world!',
        'url' => 'http://development.local/sample-page/',
        'target' => '_blank'
    ];

    private $link;
    private $linkWithoutTarget;
    private $emptyLink;

    protected function setUp() : void {
        $this->link = new Link($this->linkArray, null, []);
        $this->emptyLink = new Link(false, null, []);

        $linkArray = $this->linkArray;
        unset($linkArray['target']);
        $this->linkWithoutTarget = new Link($linkArray, null, []);
    }

    public function testUrlIsCorrect() {
        $this->assertIsString($this->link->url());
        $this->assertEquals($this->link->url(), $this->linkArray['url']);
        $this->assertNull($this->emptyLink->url());
    }

    public function testTitleIsCorrect() {
        $this->assertIsString($this->link->title());
        $this->assertEquals($this->link->title(), $this->linkArray['title']);
        $this->assertNull($this->emptyLink->title());
    }

    public function testTargetReturnTypeIsCorrect() {
        $this->assertIsString($this->link->target());
        $this->assertNull($this->linkWithoutTarget->target());
        $this->assertNull($this->emptyLink->target());
    }

    public function testTargetIsCorrect() {
        $this->assertEquals($this->link->target(), $this->linkArray['target']);
    }

    public function testLinkisCorrect() {
        $this->assertIsString($this->link->link());
        $this->assertEquals($this->link->link(), '<a href="http://development.local/sample-page/" target="_blank">Hello world!</a>');
        $this->assertEquals($this->linkWithoutTarget->link(), '<a href="http://development.local/sample-page/">Hello world!</a>');
        $this->assertEquals($this->emptyLink->title(), '');
    }

    public function testToStringIsCorrect() {
        $this->assertEquals($this->link, $this->linkArray['url']);
        $this->assertEquals($this->emptyLink, '');
    }
}
