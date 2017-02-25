<?php
namespace Mcustiel\TypedPhp\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutablePrimitivesArray;

class ImmutableDoubleArray extends ImmutablePrimitivesArray
{
    /**
     * @param double[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('double', $value);
    }
}
