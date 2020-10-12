<?php
declare(strict_types=1);

namespace Tests\Unit\Tags;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\Render;
use VU\OpenGraph\TagConfiguration;
use VU\OpenGraph\Tags\Video;

class VideoTest extends TestCase
{
    protected $config;

    public function setUp(): void
    {
        $render = new Render();
        $this->config = new TagConfiguration($render);
    }

    /**
     * @test
     */
    public function it_setter_url()
    {
        $video = new Video($this->config);

        $url = 'https://umanskyi.com/test.mp4';

        $video->setUrl($url);

        $this->assertSame($url, $video->getUrl());

    }

    /**
     * @test
     */
    public function it_setter_attribute()
    {
        $video = new Video($this->config);

        $attr = [
            'type'       => 'test',
            'secure_url' => 'https://umanskyi.com/test.mp4',
            'width'      => 1800,
            'height' => 1500,
        ];

        $video->setAttributes($attr);

        $this->assertEquals($attr, $video->getAttributes());
    }

    /**
     * @test
     */
    public function it_setter_attribute_failure()
    {
        $video = new Video($this->config);

        $attr = [
            'type'       => 'test',
            'secure_url' => 'https://umanskyi.com/test.mp4',
            'not_valid_url' => 'test'
        ];

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $video->setAttributes($attr);
    }

    /**
     * @test
     */
    public function it_setter_additional_attribute()
    {
        $video = new Video($this->config);

        $attr = [
            'actor'         => 'John Doe',
            'actor:role'    => 'Main actor',
            'director'      => 'John Doe',
            'writer'        => 'John Doe',
            'duration'      => 1024,
            'release_date'  => '2019-10-10',
            'tag'           => 'fantastic',
            'series'        => 1,
        ];

        $video->setAdditionalAttributes($attr);

        $this->assertEquals($attr, $video->getAdditionalAttributes());
    }

    /**
     * @test
     */
    public function it_setter_additional_attribute_failure()
    {
        $video = new Video($this->config);

        $attr = [
            'actor'         => 'John Doe',
            'actor:role'    => 'Main actor',
            'director'      => 'John Doe',
            'writer'        => 'John Doe',
            'duration'      => 1024,
            'release_date'  => '2019-10-10',
            'tag'           => 'fantastic',
            'series'        => 1,
            'not_valid'     => true,
        ];

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $video->setAttributes($attr);
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $video = new Video($this->config);
        $this->assertEquals([], $video->rules());
    }

    /**
     * @test
     */
    public function it_handle_additional()
    {
        $video = new Video($this->config);
        $attr = [
            'actor'         => 'John Doe',
            'actor:role'    => 'Main actor',
            'director'      => 'John Doe',
            'writer'        => 'John Doe',
            'duration'      => 1024,
            'release_date'  => '2019-10-10',
            'tag'           => 'fantastic',
            'series'        => 1,
        ];

        $video->setAdditionalAttributes($attr)->handle();

        $this->assertEquals('
<meta property="video:actor" content="John Doe">
<meta property="video:actor:role" content="Main actor">
<meta property="video:director" content="John Doe">
<meta property="video:writer" content="John Doe">
<meta property="video:duration" content="1024">
<meta property="video:release_date" content="2019-10-10">
<meta property="video:tag" content="fantastic">
<meta property="video:series" content="1">', $video->render());

    }

    /**
     * @test
     */
    public function it_handle()
    {
        $video = new Video($this->config);
        $url = 'https://umanskyi.com/test.mp4';

        $video->setUrl($url)->handle();

        $this->assertEquals('
<meta property="og:url" content="https://umanskyi.com/test.mp4">', $video->render());
    }
}
