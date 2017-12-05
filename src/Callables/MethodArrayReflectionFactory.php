<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables;

use ReflectionMethod;
use ReflectionFunctionAbstract;

class MethodArrayReflectionFactory implements CallableReflectionFactoryInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface
     */
    private $delegate;

    /**
     * Set up a method array reflection factory with the given delegate.
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
        if (is_array($callable)) {

            return new ReflectionMethod($callable[0], $callable[1]);

        }

        return ($this->delegate)($callable);
    }
}
