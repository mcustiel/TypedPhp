<?php
namespace Mcustiel\TypedPhp;

abstract class ArrayValueObject implements
    Primitive,
    \ArrayAccess,
    \IteratorAggregate,
    \Countable,
    \Serializable
{
    /**
     * @var \ArrayObject
     */
    private $array;

    /**
     * @param string $type
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
     * {@inheritDoc}
     * @see \ArrayObject::offsetSet()
     */
    public function offsetSet($index, $newval)
    {
        $this->validate($newval);
        $this->array->offsetSet($index, $newval);
    }

    /**
     * {@inheritDoc}
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return $this->array->offsetExists($offset);
    }

    /**
     * {@inheritDoc}
     * @see \ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return $this->array->offsetGet($offset);
    }

    /**
     * {@inheritDoc}
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        $this->array->offsetUnset($offset);
    }

    /**
     * {@inheritDoc}
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return $this->array->getIterator();
    }

    /**
     * {@inheritDoc}
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
