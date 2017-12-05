<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;
use Ellipse\Resolvable\Exceptions\CallableResolvingException;
use Ellipse\Resolvable\Exceptions\ParameterResolvingException;

describe('CallableResolvingException', function () {

    it('should implement ResolvingExceptionInterface', function () {

        $delegate = mock(ParameterResolvingException::class)->get();

        $test = new CallableResolvingException(stub(), $delegate);

        expect($test)->toBeAnInstanceOf(ResolvingExceptionInterface::class);

    });

});
