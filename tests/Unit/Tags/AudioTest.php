<?php
declare(strict_types=1);

namespace Tests\Unit\Tags;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\Render;
use VU\OpenGraph\TagConfiguration;
use VU\OpenGraph\Tags\Audio;

class AudioTest extends TestCase
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
        $audio = new Audio($this->config);

        $url = 'https://umanskyi.com/test.mp3';

        $audio->setUrl($url);

        $this->assertSame($url, $audio->getUrl());
    }

    /**
     * @test
     */
    public function it_setter_attribute()
    {
        $audio = new Audio($this->config);

        $attr = [
            'type'       => 'test',
            'secure_url' => 'https://umanskyi.com/test.mp3'
        ];

        $audio->setAttributes($attr);

        $this->assertEquals($attr, $audio->getAttributes());
    }

    /**
     * @test
     */
    public function it_setter_attribute_failure()
    {
        $audio = new Audio($this->config);

        $attr = [
            'type'       => 'test',
            'secure_url' => 'https://umanskyi.com/test.mp3',
            'not_valid_url' => 'test'
        ];

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $audio->setAttributes($attr);

        $this->assertEquals($attr, $audio->getAttributes());
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $audio = new Audio($this->config);
        $this->assertEquals([Audio::OG_PREFIX . 'audio',], $audio->rules());
    }

    /**
     * @test
     */
    public function it_handle_additional()
    {
        $audio = new Audio($this->config);

        $attr = [
            'type'       => 'test',
            'secure_url' => 'https://umanskyi.com/test.mp3'
        ];

        $audio->setAttributes($attr)->handle();

        $this->assertEquals('
<meta property="og:audio:type" content="test">
<meta property="og:audio:secure_url" content="https://umanskyi.com/test.mp3">', $audio->render());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $audio = new Audio($this->config);

        $url = 'https://umanskyi.com/test.mp3';

        $audio->setUrl($url)->handle();

        $this->assertEquals('
<meta property="og:audio" content="https://umanskyi.com/test.mp3">', $audio->render());
    }
}
