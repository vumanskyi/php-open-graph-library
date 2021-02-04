<?php

declare(strict_types=1);

namespace VU\OpenGraph\Properties;

use VU\OpenGraph\PropertyFactory;

class Article extends PropertyFactory
{
    /**
     * @var string
     */
    public const OG_PREFIX = 'article:';

    /**
     * @var \DateTime
     */
    protected $publish_time;

    /**
     * @var \DateTime
     */
    protected $modified_time;

    /**
     * @var \DateTime
     */
    protected $expiration_time;

    /**
     * @var string[]
     */
    protected $author = [];

    /**
     * @var string
     */
    protected $section;

    /**
     * @var string[]
     */
    protected $tag = [];

    /**
     * @return string[]
     */
    public function getAuthor(): array
    {
        return $this->author;
    }

    /**
     * @return \DateTime
     */
    public function getExpirationTime(): \DateTime
    {
        return new \DateTime($this->expiration_time);
    }

    /**
     * @return \DateTime
     */
    public function getModifiedTime(): \DateTime
    {
        return new \DateTime($this->modified_time);
    }

    /**
     * @return \DateTime
     */
    public function getPublishTime(): \DateTime
    {
        return new \DateTime($this->publish_time);
    }

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * @return string[]
     */
    public function getTag(): array
    {
        return $this->tag;
    }

    /**
     * @param string[] $tag
     *
     * @return Article
     */
    public function setTag(array $tag): Article
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @param string[] $author
     *
     * @return Article
     */
    public function setAuthor(array $author): Article
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @param \DateTime $expiration_time
     *
     * @return Article
     */
    public function setExpirationTime(\DateTime $expiration_time): Article
    {
        $this->expiration_time = $expiration_time->format('Y-m-d');

        return $this;
    }

    /**
     * @param \DateTime $modified_time
     *
     * @return Article
     */
    public function setModifiedTime(\DateTime $modified_time): Article
    {
        $this->modified_time = $modified_time->format('Y-m-d');

        return $this;
    }

    /**
     * @param \DateTime $publish_time
     *
     * @return Article
     */
    public function setPublishTime(\DateTime $publish_time): Article
    {
        $this->publish_time = $publish_time->format('Y-m-d');

        return $this;
    }

    /**
     * @param string $section
     *
     * @return Article
     */
    public function setSection(string $section): Article
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'author',
            'tag',
        ];
    }

    public function handle()
    {
        parent::handle();
        $this->additional(self::OG_PREFIX.'author', $this->getAuthor());
        $this->additional( self::OG_PREFIX.'tag', $this->getTag());
    }
}
