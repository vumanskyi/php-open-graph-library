<?php
declare(strict_types=1);

namespace Tests\Unit\Properties;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Configuration;
use VU\OpenGraph\Render;
use VU\OpenGraph\PropertyConfiguration;
use VU\OpenGraph\Properties\Article;
use VU\OpenGraph\Properties\Audio;
use VU\OpenGraph\Properties\Basic;
use VU\OpenGraph\Properties\Book;
use VU\OpenGraph\Properties\Image;
use VU\OpenGraph\Properties\Music;
use VU\OpenGraph\Properties\Profile;
use VU\OpenGraph\Properties\TwitterCard;
use VU\OpenGraph\Properties\Video;

class PropertyConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function it_instance()
    {
        $this->assertInstanceOf(Configuration::class, new PropertyConfiguration(new Render()));
    }

    /**
     * @test
     */
    public function it_properties()
    {
        $configuration = new PropertyConfiguration(new Render());

        $tags = [
            'getBasic'       => new Basic($configuration),
            'getImage'       => new Image($configuration),
            'getMusic'       => new Music($configuration),
            'getVideo'       => new Video($configuration),
            'getAudio'       => new Audio($configuration),
            'getArticle'     => new Article($configuration),
            'getBook'        => new Book($configuration),
            'getProfile'     => new Profile($configuration),
            'useTwitterCard' => new TwitterCard($configuration),
        ];

        $this->assertEquals($tags, $configuration->properties());
    }
}
