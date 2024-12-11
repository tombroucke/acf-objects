<?php

declare(strict_types=1);
use Otomaties\AcfObjects\Fields\Link;
use PHPUnit\Framework\TestCase;

function esc_url($url)
{
    return $url;
}

final class LinkTest extends TestCase
{
    private $linkArray = [
        'title' => 'Hello world!',
        'url' => 'http://development.local/sample-page/',
        'target' => '_blank',
    ];

    private $link;

    private $linkWithoutTarget;

    private $emptyLink;

    protected function setUp(): void
    {
        $this->link = new Link($this->linkArray, null, []);
        $this->emptyLink = new Link(false, null, []);

        $linkArray = $this->linkArray;
    }

    public function test_url_is_correct()
    {
        $this->assertIsString($this->link->url());
        $this->assertEquals($this->link->url(), $this->linkArray['url']);
        $this->assertNull($this->emptyLink->url());
    }

    public function test_title_is_correct()
    {
        $this->assertIsString($this->link->title());
        $this->assertEquals($this->link->title(), $this->linkArray['title']);
        $this->assertNull($this->emptyLink->title());
    }

    public function test_target_return_type_is_correct()
    {
        $this->assertIsString($this->link->target());
        $this->assertNull($this->emptyLink->target());
    }

    public function test_target_is_correct()
    {
        $this->assertEquals($this->link->target(), $this->linkArray['target']);
    }

    public function test_linkis_correct()
    {
        $this->assertEquals($this->emptyLink->title(), '');
    }

    public function test_to_string_is_correct()
    {
        $this->assertEquals($this->link, $this->linkArray['url']);
        $this->assertEquals($this->emptyLink, '');
    }
}
