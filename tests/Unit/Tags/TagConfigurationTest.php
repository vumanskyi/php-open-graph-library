<?php
declare(strict_types=1);

namespace Tests\Unit\Tags;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Configuration;
use VU\OpenGraph\Render;
use VU\OpenGraph\TagConfiguration;
use VU\OpenGraph\Tags\Article;
use VU\OpenGraph\Tags\Audio;
use VU\OpenGraph\Tags\Basic;
use VU\OpenGraph\Tags\Book;
use VU\OpenGraph\Tags\Image;
use VU\OpenGraph\Tags\Music;
use VU\OpenGraph\Tags\Profile;
use VU\OpenGraph\Tags\TwitterCard;
use VU\OpenGraph\Tags\Video;

class TagConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function it_instance()
    {
        $this->assertInstanceOf(Configuration::class, new TagConfiguration(new Render()));
    }

    /**
     * @test
     */
    public function it_tags()
    {
        $configuration = new TagConfiguration(new Render());

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

        $this->assertEquals($tags, $configuration->tags());
    }
}
