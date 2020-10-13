<?php
declare(strict_types=1);

namespace Tests\Unit\Properties;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\Render;
use VU\OpenGraph\PropertyConfiguration;
use VU\OpenGraph\Properties\Image;

class ImageTest extends TestCase
{
    protected $config;

    public function setUp(): void
    {
        $render = new Render();
        $this->config = new PropertyConfiguration($render);
    }

    /**
     * @test
     */
    public function it_setter_url()
    {
        $image = new Image($this->config);

        $url = 'https://umanskyi.com/test.png';

        $image->setUrl($url);

        $this->assertSame($url, $image->getUrl());

    }

    /**
     * @test
     */
    public function it_setter_attribute()
    {
        $image = new Image($this->config);

        $attr = [
            'width'      => 10,
            'height'     => 10,
            'type'       => 'jpg',
            'alt'        => 'Test',
            'secure_url' => 'https://umanskyi.com/test.png'
        ];

        $image->setAttributes($attr);

        $this->assertEquals($attr, $image->getAttributes());
    }

    /**
     * @test
     */
    public function it_setter_attribute_failure()
    {
        $image = new Image($this->config);

        $attr = [
            'type'       => 'jpg',
            'secure_url' => 'https://umanskyi.com/test.jpg',
            'not_valid_url' => 'test'
        ];

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $image->setAttributes($attr);

        $this->assertEquals($attr, $image->getAttributes());
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $image = new Image($this->config);
        $this->assertEquals([Image::OG_PREFIX . 'image:',], $image->rules());
    }

    /**
     * @test
     */
    public function it_handle_additional()
    {
        $image = new Image($this->config);
        $attr = [
            'width'      => 10,
            'height'     => 10,
            'type'       => 'jpg',
            'alt'        => 'Test',
            'secure_url' => 'https://umanskyi.com/test.png'
        ];

        $image->setAttributes($attr)->handle();

        $this->assertEquals('
<meta property="og:image:width" content="10">
<meta property="og:image:height" content="10">
<meta property="og:image:type" content="jpg">
<meta property="og:image:alt" content="Test">
<meta property="og:image:secure_url" content="https://umanskyi.com/test.png">', $image->render());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $image = new Image($this->config);

        $url = 'https://umanskyi.com/test.png';

        $image->setUrl($url)->handle();

        $this->assertEquals('
<meta property="og:image" content="https://umanskyi.com/test.png">', $image->render());
    }
}
