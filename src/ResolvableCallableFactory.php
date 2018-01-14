<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Ellipse\Resolvable\Callables\ClosureReflectionFactory;
use Ellipse\Resolvable\Callables\InvokableObjectReflectionFactory;
use Ellipse\Resolvable\Callables\MethodArrayReflectionFactory;
use Ellipse\Resolvable\Callables\MethodStringReflectionFactory;
use Ellipse\Resolvable\Callables\FunctionNameReflectionFactory;
use Ellipse\Resolvable\Callables\FaillingCallableReflectionFactory;

class ResolvableCallableFactory extends AbstractResolvableCallableFactory
{
    /**
     * Set up a resolvable callable factory with a default reflection factory.
     */
    public function __construct()
    {
        parent::__construct(new ClosureReflectionFactory(
            new InvokableObjectReflectionFactory(
                new MethodArrayReflectionFactory(
                    new MethodStringReflectionFactory(
                        new FunctionNameReflectionFactory(
                            new FaillingCallableReflectionFactory
                        )
                    )
                )
            )
        ));
    }
}
