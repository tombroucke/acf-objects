<?php

declare(strict_types=1);
use Otomaties\AcfObjects\Fields\Image;
use PHPUnit\Framework\TestCase;

function wp_get_attachment_image_url(int $id, string $size = 'thumbnail')
{
    return ImageTest::$imageArray['sizes'][$size];
}

function get_post_meta($id, $key, $single)
{
    if ($key == '_wp_attachment_image_alt') {
        return ImageTest::$imageArray['alt'];
    }

    return null;
}

function wp_get_attachment_image(int $id, string $size = 'thumbnail', ?bool $icon = false, $attributes = '')
{
    $output = '<img width="1024" height="255" src="'.ImageTest::$imageArray['sizes'][$size].'" class="attachment-'.$size.' size-'.$size.'" alt="" loading="lazy" srcset="'.ImageTest::$imageArray['sizes']['large'].' '.ImageTest::$imageArray['sizes']['large-width'].'w, '.ImageTest::$imageArray['sizes']['medium'].' '.ImageTest::$imageArray['sizes']['medium-width'].'w, '.ImageTest::$imageArray['sizes']['medium_large'].' 768w, '.ImageTest::$imageArray['sizes']['1536x1536'].' '.ImageTest::$imageArray['sizes']['1536x1536-width'].'w, '.ImageTest::$imageArray['sizes']['2048x2048'].' '.ImageTest::$imageArray['sizes']['2048x2048-width'].'w" sizes="(max-width: 1024px) 100vw, 1024px">';
    if (is_array($attributes) && isset($attributes['class'])) {
        $output = str_replace('attachment-'.$size.' size-'.$size, $attributes['class'], $output);
    }

    return $output;
}

final class ImageTest extends TestCase
{
    public static $imageArray = [
        'ID' => 10,
        'id' => 10,
        'title' => 'imagetitle',
        'filename' => 'imagetitle-scaled.jpg',
        'filesize' => 141059,
        'url' => 'https://example.com/imagetitle-scaled.jpg',
        'link' => 'https://example.com/hello-world/imagetitle/',
        'alt' => 'Image Title',
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
        'icon' => 'https://example.com/wp/wp-includes/images/media/default.png',
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
        ],
    ];

    private $image;

    private $imageFromID;

    private $imageFromUrl;

    private $emptyImage;

    protected function setUp(): void
    {
        $this->image = new Image(self::$imageArray, null, []);
        $this->imageFromID = new Image(2, null, []);
        $this->imageFromUrl = new Image('https://example.com/image.jpg', null, []);
        $this->emptyImage = new Image(false, null, []);
    }

    public function test_url_is_correct()
    {
        $this->assertEquals($this->image->url('medium'), 'https://example.com/imagetitle-300x75.jpg');
        $this->assertEquals($this->imageFromUrl->url('medium'), 'https://example.com/image.jpg');
        $this->assertEquals($this->imageFromUrl->default('https://example.com/defaultimage.jpg')->url('medium'), 'https://example.com/image.jpg');
        $this->assertNull($this->emptyImage->url('medium'));
        $this->assertEquals($this->emptyImage->default('https://example.com/image.jpg')->url('medium'), 'https://example.com/image.jpg');
    }

    public function test_image_alt_is_correct()
    {
        $this->assertEquals($this->image->alt(), 'Image Title');
    }

    public function test_to_string_is_correct()
    {
        $this->assertEquals((string) $this->image, 'https://example.com/imagetitle-150x150.jpg');
        $this->assertEquals($this->emptyImage, '');
    }
}
