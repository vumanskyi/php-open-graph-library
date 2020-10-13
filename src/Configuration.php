<?php

declare(strict_types=1);

namespace VU\OpenGraph;

/**
 * This is an implementation of configuration for open graph
 * With this configuration you can override exists properties and set own implementation.
 *
 * @author Vladyslav Umanskyi <vladumanskyi@gmail.com>
 */
interface Configuration
{
    /**
     * Consist all available properties.
     *
     * @return array
     */
    public function properties(): array;

    /**
     * @return RenderHandler
     */
    public function handle(): RenderHandler;
}
