<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\ResolvableValue;
use Ellipse\Resolvable\ResolvableCallable;
use Ellipse\Resolvable\ResolvableCallableFactoryInterface;
use Ellipse\Resolvable\ResolvableCallableFactory;
use Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface;

describe('ResolvableCallableFactory', function () {

    beforeEach(function () {

        $this->delegate = mock(CallableReflectionFactoryInterface::class);

        $this->factory = new ResolvableCallableFactory($this->delegate->get());

    });

    it('should implement ResolvableCallableFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(ResolvableCallableFactoryInterface::class);

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
                new ResolvableValue($callable, $parameters)
            );

            expect($test)->toEqual($resolvable);

        });

    });

});
