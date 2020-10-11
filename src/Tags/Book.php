<?php
declare(strict_types=1);

namespace VU\OpenGraph\Tags;

use VU\OpenGraph\TagFactory;

class Book extends TagFactory
{
    /**
     * @var string[]
     */
    protected $author = [];

    /**
     * @var string
     */
    protected $isbn;

    /**
     * @var \DateTime
     */
    protected $release_date;

    /**
     * @var string[]
     */
    protected $tag = [];

    /**
     * @param string[] $author
     *
     * @return Book
     */
    public function setAuthor(array $author): Book
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getAuthor(): array
    {
        return $this->author;
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
     * @return Book
     */
    public function setTag(array $tag): Book
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn(string $isbn): Book
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate(): \DateTime
    {
        return new \DateTime($this->release_date);
    }

    /**
     * @param \DateTime $release_date
     *
     * @return Book
     */
    public function setReleaseDate(\DateTime $release_date): Book
    {
        $this->release_date = $release_date->format('Y-m-d');

        return $this;
    }

    public function render()
    {
        //TODO - implementation
    }
}
