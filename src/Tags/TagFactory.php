<?php
declare(strict_types=1);

namespace VU\OpenGraph\Tags;

abstract class TagFactory
{
    /**
     * @var string
     */
    const OG_PREFIX = 'og:';


    abstract public function render();
}
