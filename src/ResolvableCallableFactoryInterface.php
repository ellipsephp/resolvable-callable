<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

interface ResolvableCallableFactoryInterface
{
    /**
     * Return a new ResolvableCallable from the given callable.
     *
     * @param callable $callable
     * @return \Ellipse\Resolvable\ResolvableCallable
     */
    public function __invoke(callable $callable): ResolvableCallable;
}
