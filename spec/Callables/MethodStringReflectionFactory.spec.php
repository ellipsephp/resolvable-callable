<?php

use function Eloquent\Phony\Kahlan\mock;
use function Eloquent\Phony\Kahlan\onStatic;

use Ellipse\Resolvable\Callables\MethodStringReflectionFactory;
use Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface;

describe('MethodStringReflectionFactory', function () {

    beforeEach(function () {

        $this->delegate = mock(CallableReflectionFactoryInterface::class);

        $this->factory = new MethodStringReflectionFactory($this->delegate->get());

    });

    it('should implement CallableReflectionFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(CallableReflectionFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        context('when the given callable is an invokable object', function () {

            it('should return an instance of ReflectionMethod', function () {

                $static = onStatic(mock(['static test' => function () {}]));

                $callable = implode('::', [$static->className(), 'test']);

                $test = ($this->factory)($callable);

                $reflection = new ReflectionMethod($static->className(), 'test');

                expect($test)->toEqual($reflection);

            });

        });

        context('when the given callable is not an invokable object', function () {

            it('should proxy the delegate ->__invoke() method', function () {

                $callable = function () {};

                $reflection = mock(ReflectionFunctionAbstract::class)->get();

                $this->delegate->__invoke->with($callable)->returns($reflection);

                $test = ($this->factory)($callable);

                expect($test)->toBe($reflection);

            });

        });

    });

});
