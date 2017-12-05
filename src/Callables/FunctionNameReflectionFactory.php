<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables;

use ReflectionFunction;
use ReflectionFunctionAbstract;

class FunctionNameReflectionFactory implements CallableReflectionFactoryInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up a function name reflection factory with the given delegate.
     *
     * @param \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface $delegate
     */
    public function __construct(CallableReflectionFactoryInterface $delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(callable $callable): ReflectionFunctionAbstract
    {
        if (is_string($callable) && strpos($callable, '::') === false) {

            return new ReflectionFunction($callable);

        }

        return ($this->delegate)($callable);
    }
}
