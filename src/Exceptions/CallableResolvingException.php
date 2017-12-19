<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Exceptions;

use RuntimeException;

class CallableResolvingException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(ParameterResolvingException $previous)
    {
        $msg = "The callable execution failed";

        parent::__construct($msg, 0, $previous);
    }
}
