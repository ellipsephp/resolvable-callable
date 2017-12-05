<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Psr\Container\ContainerInterface;

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

describe('ResolvableCallableFactory', function () {

    beforeAll(function () {

        class TestClass {}

    });

    describe('->__invoke()->value()', function () {

        it('should execute the given callable', function () {

            $instance = new TestClass;

            $container = mock(ContainerInterface::class);
            $placeholders = [2, 3];

            $container->get->with(TestClass::class)->returns($instance);

            $factory = new ResolvableCallableFactory;

            $callable = function (TestClass $p1, int $p2 = 0, int $p3, int $p4 = 4) {

                return [$p1, $p2, $p3, $p4];

            };

            $test = $factory($callable)->value($container->get(), $placeholders);

            expect($test[0])->toBe($instance);
            expect($test[1])->toEqual(2);
            expect($test[2])->toEqual(3);
            expect($test[3])->toEqual(4);

        });

    });

});
