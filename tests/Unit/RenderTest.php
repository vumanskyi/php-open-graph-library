<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use VU\OpenGraph\Exceptions\RenderException;
use VU\OpenGraph\Render;
use VU\OpenGraph\RenderHandler;

class RenderTest extends TestCase
{
    /**
     * @test
     */
    public function it_instance()
    {
        $this->assertInstanceOf(RenderHandler::class, new Render());
    }

    /**
     * @test
     */
    public function it_render()
    {
        $render = new Render();

        $this->assertEquals(
            '
<meta property="og:title" content="Test title">',
            $render->render([
                'property' => 'og:title',
                'content'  => 'Test title'
            ])
        );
    }

    /**
     * @test
     * @dataProvider renderDataProvider
     */
    public function it_render_fail($data)
    {
        $render = new Render();

        $this->expectException(RenderException::class);
        $this->expectExceptionMessage(RenderException::MESSAGE);

        $render->render($data);
    }

    /**
     * @return array
     */
    public function renderDataProvider()
    {
        return [
            [
                [
                    'property' => 'og:title',
                ]
            ],
            [
                [
                    'content' => 'Test title',
                ]
            ],
            [
                []
            ]
        ];
    }
}
