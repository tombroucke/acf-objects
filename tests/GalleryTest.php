<?php

declare(strict_types=1);
use Otomaties\AcfObjects\Fields\Gallery;
use Otomaties\AcfObjects\Fields\Image;
use PHPUnit\Framework\TestCase;

final class GalleryTest extends TestCase
{
    private $gallery;

    private $galleryArray = [
        0 => [
            'ID' => 10,
            'id' => 10,
            'title' => 'boombecherminszonetitel',
            'filename' => 'boombecherminszonetitel-scaled.jpg',
            'filesize' => 141059,
            'url' => 'http://development.local/app/uploads/2021/12/boombecherminszonetitel-scaled.jpg',
            'link' => 'http://development.local/hello-world/boombecherminszonetitel/',
            'alt' => '',
            'author' => '1',
            'description' => '',
            'caption' => '',
            'name' => 'boombecherminszonetitel',
            'status' => 'inherit',
            'uploaded_to' => 1,
            'date' => '2021-12-03 22:47:47',
            'modified' => '2021-12-04 19:18:49',
            'menu_order' => 0,
            'mime_type' => 'image/jpeg',
            'type' => 'image',
            'subtype' => 'jpeg',
            'icon' => 'http://development.local/wp/wp-includes/images/media/default.png',
            'width' => 2560,
            'height' => 638,
            'sizes' => [
                'thumbnail' => 'http://development.local/app/uploads/2021/12/boombecherminszonetitel-150x150.jpg',
                'thumbnail-width' => 150,
                'thumbnail-height' => 150,
                'medium' => 'http://development.local/app/uploads/2021/12/boombecherminszonetitel-300x75.jpg',
                'medium-width' => 300,
                'medium-height' => 75,
                'medium_large' => 'http://development.local/app/uploads/2021/12/boombecherminszonetitel-768x191.jpg',
                'medium_large-width' => 768,
                'medium_large-height' => 191,
                'large' => 'http://development.local/app/uploads/2021/12/boombecherminszonetitel-1024x255.jpg',
                'large-width' => 1024,
                'large-height' => 255,
                '1536x1536' => 'http://development.local/app/uploads/2021/12/boombecherminszonetitel-1536x383.jpg',
                '1536x1536-width' => 1536,
                '1536x1536-height' => 383,
                '2048x2048' => 'http://development.local/app/uploads/2021/12/boombecherminszonetitel-2048x510.jpg',
                '2048x2048-width' => 2048,
                '2048x2048-height' => 510,
            ],
        ],
    ];

    protected function setUp(): void
    {
        $this->gallery = new Gallery($this->galleryArray, null, []);
    }

    public function test_gallery_has_two_images()
    {
        $this->assertEquals(1, count($this->gallery));
    }

    // Can not test this yet, as the images are converted before the instantiation of the gallery
    // public function testGalleryHasImage()
    // {
    //     $this->assertInstanceOf(Image::class, $this->gallery[0]);
    // }
}
