<?php
namespace Mcustiel\TypedPhp\ValueObjects\Multiple;

class IntegerArray extends PrimitivesArray
{
    /**
     * @param int[] $value
     */
    protected function __construct(array $value)
    {
        parent::__construct('integer', $value);
    }
}
