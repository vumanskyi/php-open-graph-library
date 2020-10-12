<?php
declare(strict_types=1);

namespace Tests\Unit\Tags;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Exceptions\OpenGraphException;
use VU\OpenGraph\Render;
use VU\OpenGraph\TagConfiguration;
use VU\OpenGraph\Tags\TwitterCard;

class TwitterCardTest extends TestCase
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
    public function it_setter_site()
    {
        $twitterCard = new TwitterCard($this->config);

        $site = 'https://example.com';

        $twitterCard->setSite($site);

        $this->assertSame($site, $twitterCard->getSite());
    }

    /**
     * @test
     */
    public function it_setter_creator()
    {
        $twitterCard = new TwitterCard($this->config);

        $creator = 'John Doe';

        $twitterCard->setCreator($creator);

        $this->assertSame($creator, $twitterCard->getCreator());
    }

    /**
     * @test
     * @dataProvider dataCardProvider
     * @param $card
     */
    public function it_setter_card_success($card)
    {
        $twitterCard = new TwitterCard($this->config);

        $twitterCard->setCard($card);

        $this->assertSame($card, $twitterCard->getCard());
    }

    /**
     * @return array
     */
    public function dataCardProvider()
    {
        return [
            ['summary'],
            ['summary_large_image'],
            ['app'],
            ['player']
        ];
    }

    /**
     * @test
     */
    public function it_setter_card_failure()
    {
        $twitterCard = new TwitterCard($this->config);

        $this->expectException(OpenGraphException::class);
        $this->expectExceptionMessage('Invalid values');
        $this->expectExceptionCode(500);

        $twitterCard->setCard('test_card');
    }

    /**
     * @test
     */
    public function it_setter_title()
    {
        $twitterCard = new TwitterCard($this->config);

        $title = 'test title';

        $twitterCard->setTitle($title);

        $this->assertEquals($title, $twitterCard->getTitle());
    }

    /**
     * @test
     */
    public function it_setter_description()
    {
        $twitterCard = new TwitterCard($this->config);

        $description = 'test description';

        $twitterCard->setDescription($description);

        $this->assertEquals($description, $twitterCard->getDescription());
    }

    /**
     * @test
     */
    public function it_setter_image()
    {
        $twitterCard = new TwitterCard($this->config);

        $imagePath = 'https://umanskyi.com/image.png';

        $twitterCard->setImage($imagePath);

        $this->assertEquals($imagePath, $twitterCard->getImage());
    }

    /**
     * @test
     */
    public function it_rules()
    {
        $twitterCard = new TwitterCard($this->config);
        $this->assertEquals(['openGraph', 'validCard'], $twitterCard->rules());
    }

    /**
     * @test
     */
    public function it_handle()
    {
        $twitterCard = new TwitterCard($this->config);
        $title = 'test title';
        $imagePath = 'https://umanskyi.com/image.png';
        $creator = 'John Doe';
        $description = 'test description';
        $card = 'summary';
        $site = 'https://example.com';

        $twitterCard->setImage($imagePath)
            ->setTitle($title)
            ->setCreator($creator)
            ->setDescription($description)
            ->setCard($card)
            ->setSite($site)
            ->handle();

        $this->assertEquals('
<meta property="twitter:title" content="test title">
<meta property="twitter:description" content="test description">
<meta property="twitter:image" content="https://umanskyi.com/image.png">
<meta property="twitter:card" content="summary">
<meta property="twitter:site" content="https://example.com">
<meta property="twitter:creator" content="John Doe">', $twitterCard->render());
    }
}
