<?php declare(strict_types=1);

namespace Ellipse\Resolvable\Callables;

use ReflectionFunctionAbstract;

use Ellipse\Resolvable\Callables\Exceptions\CallableFormatNotSupportedException;

class FaillingCallableReflectionFactory implements CallableReflectionFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function __invoke(callable $callable): ReflectionFunctionAbstract
    {
        throw new CallableFormatNotSupportedException($callable);
    }
}
