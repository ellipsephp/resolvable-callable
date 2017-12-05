<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\Exceptions\ParameterResolvingException;
use Ellipse\Resolvable\Exceptions\CallableResolvingException;

class ResolvableCallable implements ResolvableValueInterface
{
    /**
     * The callable.
     *
     * @var callable
     */
    private $callable;

    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\ResolvableValue
     */
    private $delegate;

    /**
     * Set up a resolsavle callable with the given callable and resolvable
     * value.
     *
     * @param callable                              $callable
     * @param \Ellipse\Resolvable\ResolvableValue   $delegate
     */
    public function __construct(callable $callable, ResolvableValue $delegate)
    {
        $this->callable = $callable;
        $this->delegate = $delegate;
    }

    /**
     * @inheritdoc
     */
    public function value(ContainerInterface $container, array $placeholders = [])
    {
        try {

            return $this->delegate->value($container, $placeholders);

        }

        catch (ParameterResolvingException $e) {

            throw new CallableResolvingException($this->callable, $e);

        }
    }
}
