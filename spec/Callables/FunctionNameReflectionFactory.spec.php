<?php

use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Resolvable\Callables\FunctionNameReflectionFactory;
use Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface;

describe('FunctionNameReflectionFactory', function () {

    beforeEach(function () {

        $this->delegate = mock(CallableReflectionFactoryInterface::class);

        $this->factory = new FunctionNameReflectionFactory($this->delegate->get());

    });

    it('should implement CallableReflectionFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(CallableReflectionFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        context('when the given callable is a function name', function () {

            it('should return an instance of ReflectionFunction', function () {

                function function_name_reflection_factory () {};

                $test = ($this->factory)('function_name_reflection_factory');

                $reflection = new ReflectionFunction('function_name_reflection_factory');

                expect($test)->toEqual($reflection);

            });

        });

        context('when the given callable is not a function name', function () {

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
