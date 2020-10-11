<?php
declare(strict_types=1);

namespace VU\OpenGraph;

/**
 * This is an implementation of configuration for open graph
 * With this configuration you can override exists tags and set own implementation.
 *
 * @author Vladyslav Umanskyi <vladumanskyi@gmail.com>
 */
interface Configuration
{
    /**
     * Consist all available tags.
     *
     * @return array
     */
    public function tags(): array;

    /**
     * @return RenderHandler
     */
    public function handle(): RenderHandler;
}
