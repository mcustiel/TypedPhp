<?php
namespace Mcustiel\TypedPhp\Types\Multiple;

class DoubleArray extends PrimitivesArray
{
    /**
     * @param double[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('double', $value);
    }
}
