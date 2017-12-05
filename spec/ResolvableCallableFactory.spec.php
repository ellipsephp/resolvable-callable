<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Resolvable\ResolvableValue;
use Ellipse\Resolvable\ResolvableCallable;
use Ellipse\Resolvable\ResolvableCallableFactory;
use Ellipse\Resolvable\Callables\ClosureReflectionFactory;

describe('ResolvableCallableFactory', function () {

    beforeEach(function () {

        $this->delegate = mock(ClosureReflectionFactory::class);

        allow(ClosureReflectionFactory::class)->toBe($this->delegate->get());

        $this->factory = new ResolvableCallableFactory;

    });

    describe('->__invoke()', function () {

        it('should return a new ResolvableCallable from the given callable', function () {

            $callable = stub();
            $reflection = mock(ReflectionFunctionAbstract::class);
            $parameters = [
                mock(ReflectionParameter::class)->get(),
                mock(ReflectionParameter::class)->get(),
            ];

            $this->delegate->__invoke->with($callable)->returns($reflection);

            $reflection->getParameters->returns($parameters);

            $test = ($this->factory)($callable);

            $resolvable = new ResolvableCallable(
                $callable,
                new ResolvableValue($callable, $parameters)
            );

            expect($test)->toEqual($resolvable);

        });

    });

});
