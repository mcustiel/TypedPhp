<?php
namespace Mcustiel\TypedPhp\Types\Multiple;

class BooleanArray extends PrimitivesArray
{
    /**
     * @param bool[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('boolean', $value);
    }
}
