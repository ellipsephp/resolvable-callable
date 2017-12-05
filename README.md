# Resolvable callable

This package provides a resolvable callable factory allowing to execute callables using a **[Psr-11 container](http://www.php-fig.org/psr/psr-11/)**.

**Require** php >= 7.1

**Installation** `composer require ellipse/resolvable-callable`

**Run tests** `./vendor/bin/kahlan`

* [Resolve a callable](#resolve-a-callable)

## Resolve a callable

This package provides a factory producing instances of `Ellipse\Resolvable\ResolvableCallable` from callables. Those resolvable callable values can then be produced by calling the `->value()` method with a Psr-11 container and an array of placeholder values.

```php
<?php

namespace App;

use Some\Psr11Container;

use Ellipse\Resolvable\ResolvableCallableFactory;

// The callable to resolve.
$callable = function (SomeClass $p1, int $p2 = 0, int $p3, string $p4 = 'p4') {

    // $p1 is the instance returned by $container->get(SomeClass::class);
    // $p2 value is 2
    // $p3 value is 3
    // $p3 value is 'p4'

    return 'result';

};

// Some Psr-11 container.
$container = new Psr11Container;

// Resolve the callable. $resolved value is 'result'.
$factory = new ResolvableCallableFactory;

$resolved = $factory($callable)->value($container, [2, 3]);
```
