<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables;

use Closure;
use ReflectionMethod;
use ReflectionFunctionAbstract;

class InvokableObjectReflectionFactory implements CallableReflectionFactoryInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up an invokable object reflection factory with the given delegate.
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
        if (is_object($callable) && ! $callable instanceof Closure) {

            return new ReflectionMethod($callable, '__invoke');

        }

        return ($this->delegate)($callable);
    }
}
