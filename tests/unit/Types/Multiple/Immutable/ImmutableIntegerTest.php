<?php
namespace Mcustiel\TypedPhp\Test\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableIntegerArray;

class ImmutableIntegerArrayTest extends ImmutableArrayAsserts
{
    /**
     * @test
     */
    public function shouldFailWhenTryingToAddData()
    {
        $this->assertAddingDataNotAllowed(ImmutableIntegerArray::class, [1, 2, 3], 4);
    }

    /**
     * @test
     */
    public function shouldFailWhenTryingToRemoveData()
    {
        $this->assertRemovingDataNotAllowed(ImmutableIntegerArray::class, [1, 2, 3]);
    }
}
