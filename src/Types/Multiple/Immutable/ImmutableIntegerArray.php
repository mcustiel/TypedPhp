<?php

namespace Mcustiel\TypedPhp\Types\Multiple\Immutable;

class ImmutableIntegerArray extends ImmutablePrimitivesArray
{
    /**
     * @param int[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('integer', $value);
    }
}
