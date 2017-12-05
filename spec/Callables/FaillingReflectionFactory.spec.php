<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Resolvable\Callables\FaillingCallableReflectionFactory;
use Ellipse\Resolvable\Callables\CallableReflectionFactoryInterface;
use Ellipse\Resolvable\Callables\Exceptions\CallableFormatNotSupportedException;

describe('FaillingCallableReflectionFactory', function () {

    beforeEach(function () {

        $this->factory = new FaillingCallableReflectionFactory;

    });

    it('should implement CallableReflectionFactoryInterface', function () {

        expect($this->factory)->toBeAnInstanceOf(CallableReflectionFactoryInterface::class);

    });

    describe('->__invoke()', function () {

        it('should throw a CallableFormatNotSupportedException', function () {

            $callable = stub();

            $test = function () use ($callable) {

                ($this->factory)($callable);

            };

            $exception = new CallableFormatNotSupportedException($callable);

            expect($test)->toThrow($exception);

        });

    });

});
