<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Ellipse\Resolvable\Callables\ClosureReflectionFactory;
use Ellipse\Resolvable\Callables\InvokableObjectReflectionFactory;
use Ellipse\Resolvable\Callables\MethodArrayReflectionFactory;
use Ellipse\Resolvable\Callables\MethodStringReflectionFactory;
use Ellipse\Resolvable\Callables\FunctionNameReflectionFactory;
use Ellipse\Resolvable\Callables\FaillingCallableReflectionFactory;

class ResolvableCallableFactory
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up a resolvable callable factory.
     */
    public function __construct()
    {
        $this->delegate = new ClosureReflectionFactory(
            new InvokableObjectReflectionFactory(
                new MethodArrayReflectionFactory(
                    new MethodStringReflectionFactory(
                        new FunctionNameReflectionFactory(
                            new FaillingCallableReflectionFactory
                        )
                    )
                )
            )
        );
    }

    /**
     * Return a new ResolvableValue from the given callable.
     *
     * @param callable $callable
     * @return \Ellipse\Resolvable\ResolvableCallable
     */
    public function __invoke(callable $callable): ResolvableCallable
    {
        $reflection = ($this->delegate)($callable);

        $parameters = $reflection->getParameters();

        return new ResolvableCallable(
            $callable,
            new ResolvableValue($callable, $parameters)
        );
    }
}
