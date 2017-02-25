<?php
namespace Mcustiel\TypedPhp\Types\Multiple;

class IntegerArray extends PrimitivesArray
{
    /**
     * @param int[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('integer', $value);
    }
}
