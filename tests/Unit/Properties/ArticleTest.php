<?php
declare(strict_types=1);

namespace Tests\Unit\Properties;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Render;
use VU\OpenGraph\PropertyConfiguration;
use VU\OpenGraph\Properties\Article;

class ArticleTest extends TestCase
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
    public function it_setter_author()
    {
        $article = new Article($this->config);

        $authors = ['John Doe', 'Mike Doe'];

        $article->setAuthor($authors);

        $this->assertSame($authors, $article->getAuthor());
    }

    /**
     * @test
     */
    public function it_setter_dates()
    {
        $article = new Article($this->config);

        $date = new \DateTime('2011-01-01');

        $article->setExpirationTime($date)->setModifiedTime($date)->setPublishTime($date);

        $this->assertEquals($date, $article->getExpirationTime());
        $this->assertEquals($date, $article->getModifiedTime());
        $this->assertEquals($date, $article->getPublishTime());
    }

    /**
     * @test
     */
    public function it_setter_tags()
    {
        $article = new Article($this->config);

        $tags = ['test_tag', 'srcond_test_tag'];

        $article->setTag($tags);

        $this->assertSame($tags, $article->getTag());

    }

    /**
     * @test
     */
    public function it_setter_section()
    {
        $article = new Article($this->config);

        $section = "TEST_SECTION";

        $article->setSection($section);

        $this->assertSame($section, $article->getSection());
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $article = new Article($this->config);

        $this->assertEquals(['author', 'tag'], $article->rules());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $article = new Article($this->config);


        $tags = ['test_tag', 'srcond_test_tag'];

        $article->setTag($tags);
        $authors = ['John Doe', 'Mike Doe'];

        $article->setAuthor($authors);

        $article->handle();

        $this->assertSame('
<meta property="article:author" content="John Doe">
<meta property="article:author" content="Mike Doe">
<meta property="article:tag" content="test_tag">
<meta property="article:tag" content="srcond_test_tag">', $article->render());
    }
}
