<?php

namespace Mcustiel\TypedPhp\Types\Multiple\Immutable;

class ImmutableBooleanArray extends ImmutablePrimitivesArray
{
    /**
     * @param int[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('boolean', $value);
    }
}
