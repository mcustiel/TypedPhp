<?php
namespace Mcustiel\TypedPhp;

abstract class ArrayValueObject extends \ArrayObject implements Primitive
{
    /**
     * @param string $type
     * @param array $value
     */
    public function __construct(array $value)
    {
        $this->checkArrayTypes($value);
        parent::__construct($value);
    }

    /**
     * @return array
     */
    public function value()
    {
        return $this->getArrayCopy();
    }

    /**
     * {@inheritDoc}
     * @see \ArrayObject::offsetSet()
     */
    public function offsetSet($index, $newval)
    {
        $this->validate($newval);
        parent::offsetSet($index, $newval);
    }

    /**
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    abstract protected function validate($value);

    /**
     * @param array $array
     * @param string $type
     *
     * @throws \InvalidArgumentException
     */
    protected function checkArrayTypes(array $array)
    {
        foreach ($array as $element) {
            $this->validate($element);
        }
    }
}
