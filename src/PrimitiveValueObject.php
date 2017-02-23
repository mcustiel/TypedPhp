<?php
namespace Mcustiel\TypedPhp;

abstract class PrimitiveValueObject implements Primitive
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\Primitive::get()
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    abstract protected function validate($value);
}
