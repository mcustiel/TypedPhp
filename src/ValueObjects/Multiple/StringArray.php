<?php
namespace Mcustiel\TypedPhp\ValueObjects\Multiple;

class StringArray extends PrimitivesArray
{
    /**
     * @param string[] $value
     */
    public function __construct(array $value)
    {
        parent::__construct('string', $value);
    }
}
