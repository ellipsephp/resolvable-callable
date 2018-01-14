<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface;

abstract class AbstractResolvableCallableFactory implements ResolvableCallableFactoryInterface
{
    /**
     * The reflection factory.
     *
     * @var \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface
     */
    private $reflection;

    /**
     * Set up a resolvable callable factory with the given reflection factory.
     *
     * @param \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface $reflection
     */
    public function __construct(CallableReflectionFactoryInterface $reflection)
    {
        $this->reflection = $reflection;
    }

    /**
     * Return a new ResolvableValue from the given callable.
     *
     * @param callable $callable
     * @return \Ellipse\Resolvable\ResolvableCallable
     */
    public function __invoke(callable $callable): ResolvableCallable
    {
        $reflection = ($this->reflection)($callable);

        $parameters = $reflection->getParameters();

        return new ResolvableCallable(
            new ResolvableValue($callable, $parameters)
        );
    }
}
