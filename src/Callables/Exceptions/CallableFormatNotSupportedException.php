<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables\Exceptions;

use RuntimeException;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;

class CallableFormatNotSupportedException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(callable $callable)
    {
        $template = "Unsupported callable format: %s";

        $msg = sprintf($template, print_r($callable, true));

        parent::__construct($msg);
    }
}
