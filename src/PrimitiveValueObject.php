<?php

namespace Mcustiel\TypedPhp;

abstract class PrimitiveValueObject implements Primitive, \Serializable
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
     * {@inheritdoc}
     *
     * @see \Mcustiel\TypedPhp\Primitive::get()
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize($this->value);
    }

    /**
     * @param string $serialized
     *
     * @return string
     */
    public function unserialize($serialized)
    {
        $this->value = unserialize($serialized);
    }

    /**
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    abstract protected function validate($value);
}
