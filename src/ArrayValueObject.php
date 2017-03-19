<?php

namespace Mcustiel\TypedPhp;

abstract class ArrayValueObject implements Primitive, \ArrayAccess, \IteratorAggregate, \Countable, \Serializable
{
    /**
     * @var \ArrayObject
     */
    private $array;

    /**
     * @param array $value
     */
    public function __construct(array $value = [])
    {
        $this->checkArrayTypes($value);
        $this->array = new \ArrayObject($value);
    }

    /**
     * @return array
     */
    public function value()
    {
        return $this->array->getArrayCopy();
    }

    /**
     * {@inheritdoc}
     *
     * @see \ArrayObject::offsetSet()
     */
    public function offsetSet($index, $newval)
    {
        $this->validate($newval);
        $this->array->offsetSet($index, $newval);
    }

    /**
     * {@inheritdoc}
     *
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return $this->array->offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     *
     * @see \ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return $this->array->offsetGet($offset);
    }

    /**
     * {@inheritdoc}
     *
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        $this->array->offsetUnset($offset);
    }

    /**
     * {@inheritdoc}
     *
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return $this->array->getIterator();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Countable::count()
     */
    public function count()
    {
        return $this->array->count();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize($this->array);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->array = unserialize($serialized);
    }

    public function __toString()
    {
        return print_r($this->value(), true);
    }

    /**
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    abstract protected function validate($value);

    /**
     * @param array $array
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
