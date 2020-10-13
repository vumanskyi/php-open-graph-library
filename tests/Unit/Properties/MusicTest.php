<?php
declare(strict_types=1);

namespace Tests\Unit\Properties;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\Render;
use VU\OpenGraph\PropertyConfiguration;
use VU\OpenGraph\Properties\Music;

class MusicTest extends TestCase
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
    public function it_setter_song()
    {
        $music = new Music($this->config);

        $url = 'https://umanskyi.com/test';

        $music->setSong($url);

        $this->assertSame($url, $music->getSong());
    }

    /**
     * @test
     */
    public function it_setter_creator()
    {
        $music = new Music($this->config);

        $url = 'John Doe';

        $music->setCreator($url);

        $this->assertSame($url, $music->getCreator());

    }

    /**
     * @test
     */
    public function it_setter_attribute_album()
    {
        $music = new Music($this->config);

        $attr = [
            'album'         => 'Test Album',
            'album:disc'    => "Second",
            'album:track'   => 'second',
        ];

        $music->setAttrAlbum($attr);

        $this->assertEquals($attr, $music->getAttrAlbum());
    }

    /**
     * @test
     */
    public function it_setter_attribute_album_failure()
    {
        $music = new Music($this->config);

        $attr = [
            'album'         => 'Test Album',
            'album:disc'    => 'Second',
            'album:track'   => 'second',
            'album:not_valid' => 'test'
        ];

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $music->setAttrAlbum($attr);
    }

    /**
     * @test
     */
    public function it_setter_attribute_song()
    {
        $music = new Music($this->config);

        $attr = [
            'song:disc'    => 'Second',
            'song:track'   => 'second',
        ];

        $url = 'https://umanskyi.com/test';
        $music->setSong($url, $attr);

        $this->assertEquals($url, $music->getSong());
        $this->assertEquals($attr, $music->getAttrSong());
    }

    /**
     * @test
     */
    public function it_setter_attribute_song_failure()
    {
        $music = new Music($this->config);

        $attr = [
            'song:disc'    => 'Second',
            'song:track'   => 'second',
            'song:not_valid' => 'test'
        ];

        $url = 'https://umanskyi.com/test';

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $music->setSong($url, $attr);
    }

    /**
     * @test
     */
    public function it_setter_release_date()
    {
        $music = new Music($this->config);

        $date = new \DateTime('2011-01-01');

        $music->setReleaseDate($date);

        $this->assertEquals($date, $music->getReleaseDate());
    }

    /**
     * @test
     */
    public function it_setter_duration()
    {
        $music = new Music($this->config);

        $duration = 105;

        $music->setDuration($duration);

        $this->assertSame($duration, $music->getDuration());
    }

    /**
     * @test
     */
    public function it_setter_author()
    {
        $music = new Music($this->config);

        $authors = ['John Doe', 'Mike Doe'];

        $music->setMusician($authors);

        $this->assertSame($authors, $music->getMusician());
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $music = new Music($this->config);
        $this->assertEquals(
            [
                'attrAlbum',
                'attrSong',
                'validAttrAlbum',
                'validAttrSong',
                'musician'
            ],
            $music->rules()
        );
    }

    /**
     * @test
     */
    public function it_handle_additional()
    {
        $music = new Music($this->config);

        $authors = ['John Doe', 'Mike Doe'];

        $music->setMusician($authors)->handle();

        $this->assertEquals('
<meta property="music:musician" content="John Doe">
<meta property="music:musician" content="Mike Doe">', $music->render());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $music = new Music($this->config);
        $url = 'https://umanskyi.com/test';

        $music->setSong($url)->handle();

        $this->assertEquals('
<meta property="music:song" content="https://umanskyi.com/test">', $music->render());
    }
}
