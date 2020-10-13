<?php

declare(strict_types=1);

namespace VU\OpenGraph\Exceptions;

use Throwable;

class OpenGraphException extends \Exception
{
    /**
     * @var string
     */
    const MESSAGE = '[x] Something went wrong with Open Graph';

    /**
     * OpenGraphException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = self::MESSAGE, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
