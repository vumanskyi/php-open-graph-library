<?php

declare(strict_types=1);

namespace VU\OpenGraph\Exceptions;

use Throwable;

class RenderException extends \Exception
{
    /**
     * @var string
     */
    const MESSAGE = 'Invalid fields - property or content';

    /**
     * RenderException constructor.
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
