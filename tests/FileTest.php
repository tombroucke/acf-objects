<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Otomaties\AcfObjects\File;

final class FileTest extends TestCase
{
    private $fileArray = [
        'ID' => 10,
        'id' => 10,
        'title' => 'imagetitle',
        'filename' => 'imagetitle-scaled.jpg',
        'filesize' => 141059,
        'url' => 'https://example.com/imagetitle-scaled.jpg',
        'link' => 'http://development.local/hello-world/imagetitle/',
        'alt' => '',
        'author' => '1',
        'description' => '',
        'caption' => '',
        'name' => 'imagetitle',
        'status' => 'inherit',
        'uploaded_to' => 1,
        'date' => '2021-12-03 22:47:47',
        'modified' => '2021-12-03 22:47:47',
        'menu_order' => 0,
        'mime_type' => 'image/jpeg',
        'type' => 'image',
        'subtype' => 'jpeg',
        'icon' => 'http://development.local/wp/wp-includes/images/media/default.png',
        'width' => 2560,
        'height' => 638,
        'sizes' => [
          'thumbnail' => 'https://example.com/imagetitle-150x150.jpg',
          'thumbnail-width' => 150,
          'thumbnail-height' => 150,
          'medium' => 'https://example.com/imagetitle-300x75.jpg',
          'medium-width' => 300,
          'medium-height' => 75,
          'medium_large' => 'https://example.com/imagetitle-768x191.jpg',
          'medium_large-width' => 768,
          'medium_large-height' => 191,
          'large' => 'https://example.com/imagetitle-1024x255.jpg',
          'large-width' => 1024,
          'large-height' => 255,
          '1536x1536' => 'https://example.com/imagetitle-1536x383.jpg',
          '1536x1536-width' => 1536,
          '1536x1536-height' => 383,
          '2048x2048' => 'https://example.com/imagetitle-2048x510.jpg',
          '2048x2048-width' => 2048,
          '2048x2048-height' => 510,
        ]
    ];

    private $file;
    private $emptyFile;

    protected function setUp() : void {
        $this->file = new File($this->fileArray, null, []);
        $this->emptyFile = new File([], null, []);
    }

    public function testUrl() {
        $this->assertEquals('https://example.com/imagetitle-scaled.jpg', $this->file->url());
        $this->assertNull($this->emptyFile->url());
    }

    public function testTitle() {
        $this->assertEquals('imagetitle', $this->file->title());
        $this->assertNull($this->emptyFile->title());
    }

    public function testMimeType() {
        $this->assertEquals('image/jpeg', $this->file->mimeType());
        $this->assertNull($this->emptyFile->mimeType());
    }

    public function testWidth() {
        $this->assertEquals(2560, $this->file->width());
        $this->assertNull($this->emptyFile->width());
    }

    public function testHeight() {
        $this->assertEquals(638, $this->file->height());
        $this->assertNull($this->emptyFile->height());
    }
}
