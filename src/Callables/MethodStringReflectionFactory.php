<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables;

use ReflectionMethod;
use ReflectionFunctionAbstract;

class MethodStringReflectionFactory implements CallableReflectionFactoryInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up a method string reflection factory with the given delegate.
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
        if (is_string($callable) && strpos($callable, '::') !== false) {

            return new ReflectionMethod($callable);

        }

        return ($this->delegate)($callable);
    }
}
