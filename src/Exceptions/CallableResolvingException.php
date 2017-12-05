<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Exceptions;

use RuntimeException;

class CallableResolvingException extends RuntimeException implements ResolvingExceptionInterface
{
    public function __construct(callable $callable, ParameterResolvingException $delegate)
    {
        $msg = "The given callable execution failed because $%s value can't be resolved:\n-%s";

        parent::__construct(sprintf($msg, $delegate->parameter()->getName(), $delegate->getMessage()));
    }
}
