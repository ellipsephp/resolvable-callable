<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\ResolvableValueInterface;
use Ellipse\Resolvable\ResolvableValue;
use Ellipse\Resolvable\ResolvableCallable;
use Ellipse\Resolvable\Exceptions\CallableResolvingException;
use Ellipse\Resolvable\Exceptions\ParameterResolvingException;

describe('ResolvableCallable', function () {

    beforeEach(function () {

        $this->callable = stub();
        $this->delegate = mock(ResolvableValue::class);

        $this->resolvable = new ResolvableCallable($this->callable, $this->delegate->get());

    });

    it('should implement ResolvableValueInterface', function () {

        expect($this->resolvable)->toBeAnInstanceOf(ResolvableValueInterface::class);

    });

    describe('->value()', function () {

        beforeEach(function () {

            $this->container = mock(ContainerInterface::class)->get();

            $this->placeholders = ['p1', 'p2'];

        });

        context('when no ParameterResolvingException is thrown', function () {

            it('should proxy the delegate->value() method', function () {

                $this->delegate->value->with($this->container, $this->placeholders)->returns('value');

                $test = $this->resolvable->value($this->container, $this->placeholders);

                expect($test)->toEqual('value');

            });

        });

        context('when a ParameterResolvingException is thrown', function () {

            it('should wrap it inside a CallableResolvingException', function () {

                $exception = mock(ParameterResolvingException::class)->get();

                $this->delegate->value->with($this->container, $this->placeholders)->throws($exception);

                $test = function () {

                     $this->resolvable->value($this->container, $this->placeholders);

                };

                $exception = new CallableResolvingException($exception);

                expect($test)->toThrow($exception);

            });

        });

    });

});
