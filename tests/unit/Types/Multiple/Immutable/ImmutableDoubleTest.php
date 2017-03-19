<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableDoubleArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableDoubleArray
 * @covers \Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutablePrimitivesArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class ImmutableDoubleTest extends ImmutableArrayAsserts
{
    /**
     * @test
     */
    public function shouldFailWhenTryingToAddData()
    {
        $this->assertAddingDataNotAllowed(ImmutableDoubleArray::class, [1.1, 2.2], 3.3);
    }

    /**
     * @test
     */
    public function shouldFailWhenTryingToRemoveData()
    {
        $this->assertRemovingDataNotAllowed(ImmutableDoubleArray::class, [1.1, 2.2, 3.3]);
    }
}
