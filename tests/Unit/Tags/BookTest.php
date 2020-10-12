<?php
declare(strict_types=1);

namespace Tests\Unit\Tags;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Render;
use VU\OpenGraph\TagConfiguration;
use VU\OpenGraph\Tags\Book;

class BookTest extends TestCase
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
    public function it_setter_author()
    {
        $book = new Book($this->config);

        $authors = ['John Doe', 'Mike Doe'];

        $book->setAuthor($authors);

        $this->assertSame($authors, $book->getAuthor());
    }

    /**
     * @test
     */
    public function it_setter_release_date()
    {
        $book = new Book($this->config);

        $date = new \DateTime('2011-01-01');

        $book->setReleaseDate($date);

        $this->assertEquals($date, $book->getReleaseDate());
    }

    /**
     * @test
     */
    public function it_setter_tag()
    {
        $book = new Book($this->config);

        $tags = ['Avatar', 'Game'];

        $book->setTag($tags);

        $this->assertSame($tags, $book->getTag());
    }

    /**
     * @test
     */
    public function it_setter_isbn()
    {
        $book = new Book($this->config);

        $isbn = '9305581bn34';

        $book->setIsbn($isbn);

        $this->assertSame($isbn, $book->getIsbn());
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $book = new Book($this->config);

        $this->assertEquals(['author', 'tag'], $book->rules());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $book = new Book($this->config);

        $isbn = '9305581bn34';
        $tags = ['Avatar', 'Game'];

        $book->setIsbn($isbn)->setTag($tags)->handle();

        $this->assertEquals('
<meta property="book:isbn" content="9305581bn34">
<meta property="book:tag" content="Avatar">
<meta property="book:tag" content="Game">', $book->render());
    }
}
