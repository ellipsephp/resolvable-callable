<?php

use function Eloquent\Phony\Kahlan\stub;

use Ellipse\Resolvable\Exceptions\ResolvingExceptionInterface;
use Ellipse\Resolvable\Callables\Exceptions\CallableFormatNotSupportedException;

describe('CallableFormatNotSupportedException', function () {

    it('should implement ResolvingExceptionInterface', function () {

        $test = new CallableFormatNotSupportedException(stub());

        expect($test)->toBeAnInstanceOf(ResolvingExceptionInterface::class);

    });

});
