<?php
declare(strict_types=1);

namespace Tests\Unit\Properties;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Render;
use VU\OpenGraph\PropertyConfiguration;
use VU\OpenGraph\Properties\Basic;

class BasicTest extends TestCase
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
    public function settersAndGetters()
    {
        $basic = new Basic($this->config);

        $url = 'https://example.com';
        $altLocale = ['en_US', 'pl_PL'];
        $locale = 'fr_FR';
        $title = 'Test title';
        $description = 'Test description';
        $type = 'Test_TYPE';
        $siteName = 'example.com';
        $determiner = 'test';

        $basic->setUrl($url)
            ->setLocalAlternate($altLocale)
            ->setLocale($locale)
            ->setTitle($title)
            ->setDescription($description)
            ->setType($type)
            ->setDeterminer($determiner)
            ->setSiteName($siteName);

        $this->assertSame($url, $basic->getUrl());
        $this->assertSame($altLocale, $basic->getLocalAlternate());
        $this->assertSame($locale, $basic->getLocale());
        $this->assertSame($title, $basic->getTitle());
        $this->assertSame($description, $basic->getDescription());
        $this->assertSame($type, $basic->getType());
        $this->assertSame($determiner, $basic->getDeterminer());
        $this->assertSame($siteName, $basic->getSiteName());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $locale = 'fr_FR';
        $title = 'Test title';
        $description = 'Test description';

        $basic = new Basic($this->config);
        $basic->setTitle($title)
            ->setDescription($description)
            ->setLocale($locale);

        $basic->handle();
        $this->assertEquals('
<meta property="og:title" content="Test title">
<meta property="og:description" content="Test description">
<meta property="og:locale" content="fr_FR">', $basic->render());
    }
}
