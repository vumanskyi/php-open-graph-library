<?php

declare(strict_types=1);

namespace VU\OpenGraph;

use VU\OpenGraph\Properties\Article;
use VU\OpenGraph\Properties\Audio;
use VU\OpenGraph\Properties\Basic;
use VU\OpenGraph\Properties\Book;
use VU\OpenGraph\Properties\Image;
use VU\OpenGraph\Properties\Music;
use VU\OpenGraph\Properties\Profile;
use VU\OpenGraph\Properties\TwitterCard;
use VU\OpenGraph\Properties\Video;

/**
 * @method Article     getArticle()
 * @method Image       getImage()
 * @method Audio       getAudio()
 * @method Book        getBook()
 * @method Basic       getBasic()
 * @method Music       getMusic()
 * @method Profile     getProfile()
 * @method Video       getVideo()
 * @method TwitterCard useTwitterCard()
 */
class PropertyConfiguration implements Configuration
{
    /**
     * @var RenderHandler
     */
    private $handler;

    /**
     * TagConfiguration constructor.
     *
     * @param RenderHandler $handler
     */
    public function __construct(RenderHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function properties(): array
    {
        return [
            'getBasic'       => new Basic($this),
            'getImage'       => new Image($this),
            'getMusic'       => new Music($this),
            'getVideo'       => new Video($this),
            'getAudio'       => new Audio($this),
            'getArticle'     => new Article($this),
            'getBook'        => new Book($this),
            'getProfile'     => new Profile($this),
            'useTwitterCard' => new TwitterCard($this),
        ];
    }

    /**
     * @return RenderHandler
     */
    public function handle(): RenderHandler
    {
        return $this->handler;
    }
}
