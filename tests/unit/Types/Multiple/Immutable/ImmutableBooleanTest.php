<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableBooleanArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableBooleanArray
 * @covers \Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutablePrimitivesArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class ImmutableBooleanTest extends ImmutableArrayAsserts
{
    /**
     * @test
     */
    public function shouldFailWhenTryingToAddData()
    {
        $this->assertAddingDataNotAllowed(ImmutableBooleanArray::class, [true, false, true], false);
    }

    /**
     * @test
     */
    public function shouldFailWhenTryingToRemoveData()
    {
        $this->assertRemovingDataNotAllowed(ImmutableBooleanArray::class, [true, false, true]);
    }
}
