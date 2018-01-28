<?php

use function Eloquent\Phony\Kahlan\mock;
use function Eloquent\Phony\Kahlan\onStatic;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\ResolvableCallable;
use Ellipse\Resolvable\ResolvableCallableFactoryInterface;
use Ellipse\Resolvable\DefaultResolvableCallableFactory;

describe('DefaultResolvableCallableFactory', function () {

    beforeEach(function () {

        $this->factory = new DefaultResolvableCallableFactory;

    });

    it('should implement ResolvableCallableFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(ResolvableCallableFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        it('should return a new ResolvableCallable from the given closure', function () {

            $callable = function () {};

            $test = ($this->factory)($callable);

            expect($test)->toBeAnInstanceOf(ResolvableCallable::class);

        });

        it('should return a new ResolvableCallable from an invokable object', function () {

            $callable = mock(['__invoke' => function () {}])->get();

            $test = ($this->factory)($callable);

            expect($test)->toBeAnInstanceOf(ResolvableCallable::class);

        });

        it('should return a new ResolvableCallable from an array representing an instance method', function () {

            $instance = mock(['test' => function () {}])->get();

            $callable = [$instance, 'test'];

            $test = ($this->factory)($callable);

            expect($test)->toBeAnInstanceOf(ResolvableCallable::class);

        });

        it('should return a new ResolvableCallable from an array representing a static method', function () {

            $class = onStatic(mock(['static test' => function () {}]))->className();

            $callable = [$class, 'test'];

            $test = ($this->factory)($callable);

            expect($test)->toBeAnInstanceOf(ResolvableCallable::class);

        });

        it('should return a new ResolvableCallable from a string representing a static method', function () {

            $class = onStatic(mock(['static test' => function () {}]))->className();

            $callable = implode('::', [$class, 'test']);

            $test = ($this->factory)($callable);

            expect($test)->toBeAnInstanceOf(ResolvableCallable::class);

        });

        it('should return a new ResolvableCallable from the given function name', function () {

            function resolvable_callable_factory_test() {}

            $test = ($this->factory)('resolvable_callable_factory_test');

            expect($test)->toBeAnInstanceOf(ResolvableCallable::class);

        });

    });

});
