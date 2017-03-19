<?php

namespace Mcustiel\TypedPhp\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Types\Multiple\ObjectsArray;

class ImmutableObjectsArray extends ObjectsArray
{
    /**
     * {@inheritdoc}
     *
     * @see \ArrayObject::offsetSet()
     */
    public function offsetSet($index, $newval)
    {
        throw new \RuntimeException('Trying to mutate an immutable object');
    }

    /**
     * {@inheritdoc}
     *
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        throw new \RuntimeException('Trying to mutate an immutable object');
    }
}
