<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables;

use Closure;
use ReflectionFunction;
use ReflectionFunctionAbstract;

class ClosureReflectionFactory implements CallableReflectionFactoryInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up a closure reflection factory with the given delegate.
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
        if ($callable instanceof Closure) {

            return new ReflectionFunction($callable);

        }

        return ($this->delegate)($callable);
    }
}
