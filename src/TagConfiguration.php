<?php
declare(strict_types=1);

namespace VU\OpenGraph;

use VU\OpenGraph\Tags\Article;
use VU\OpenGraph\Tags\Audio;
use VU\OpenGraph\Tags\Basic;
use VU\OpenGraph\Tags\Book;
use VU\OpenGraph\Tags\Image;
use VU\OpenGraph\Tags\Music;
use VU\OpenGraph\Tags\Profile;
use VU\OpenGraph\Tags\TwitterCard;
use VU\OpenGraph\Tags\Video;

class TagConfiguration implements Configuration
{
    /**
     * @var RenderHandler
     */
    private $handler;

    /**
     * TagConfiguration constructor.
     * @param RenderHandler $handler
     */
    public function __construct(RenderHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function tags(): array
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
