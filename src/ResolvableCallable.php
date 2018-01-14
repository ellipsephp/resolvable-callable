<?php declare(strict_types=1);

namespace Ellipse\Resolvable;

use Psr\Container\ContainerInterface;

use Ellipse\Resolvable\Exceptions\ParameterResolvingException;
use Ellipse\Resolvable\Exceptions\CallableResolvingException;

class ResolvableCallable implements ResolvableValueInterface
{
    /**
     * The delegate.
     *
     * @var \Ellipse\Resolvable\ResolvableValue
     */
    private $delegate;

    /**
     * Set up a resolvable callable with the given delegate.
     *
     * @param \Ellipse\Resolvable\ResolvableValue $delegate
     */
    public function __construct(ResolvableValue $delegate)
    {
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

            throw new CallableResolvingException($e);

        }
    }
}
