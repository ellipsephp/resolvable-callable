<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables\Exceptions;

use RuntimeException;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;

class CallableFormatNotSupportedException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(callable $callable)
    {
        $msg = "Unsupported callable format: %s.";

        parent::__construct(sprintf($msg, print_r($callable, true)));
    }
}
