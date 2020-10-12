<?php
declare(strict_types=1);

namespace VU\OpenGraph;

interface RenderHandler
{
    /**
     * @param array $data
     *
     * @return string|void
     */
    public function render(array $data);

    /**
     * Display content according to the input params
     *
     * @return string
     */
    public function content(): string;
}
