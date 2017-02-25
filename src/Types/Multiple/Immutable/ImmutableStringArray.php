<?php
namespace Mcustiel\TypedPhp\Types\Multiple\Immutable;

class ImmutableStringArray extends ImmutablePrimitivesArray
{
    /**
     * @param string[] $value
     */
    public function __construct(array $value = [])
    {
        parent::__construct('string', $value);
    }
}
