<?php
namespace Mcustiel\TypedPhp\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Types\Multiple\ObjectsArray;

class ImmutableObjectsArray extends ObjectsArray
{
    /**
     * {@inheritDoc}
     * @see \ArrayObject::offsetSet()
     */
    public function offsetSet($index, $newval)
    {
        throw new \RuntimeException('Trying to mutate an immutable object');
    }

    /**
     * {@inheritDoc}
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        throw new \RuntimeException('Trying to mutate an immutable object');
    }
}
