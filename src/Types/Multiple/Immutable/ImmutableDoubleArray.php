<?php

namespace Mcustiel\TypedPhp\Types\Multiple\Immutable;

class ImmutableDoubleArray extends ImmutablePrimitivesArray
{
    /**
     * @param float[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('double', $value);
    }
}
