<?php

declare(strict_types=1);

namespace VU\OpenGraph;

use VU\OpenGraph\Exceptions\RenderException;

class Render implements RenderHandler
{
    protected $content = '';

    /**
     * @var string
     */
    protected $template = '<meta property="{property}" content="{content}">';

    /**
     * {@inheritdoc}
     *
     * @throws RenderException
     */
    public function render(array $data)
    {
        if (empty($data['property']) || empty($data['content'])) {
            throw new RenderException();
        }

        $this->content .= PHP_EOL.strtr($this->template, [
            '{property}' => $data['property'],
            '{content}'  => $data['content'],
        ]);

        return $this->content;
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->content;
    }
}
