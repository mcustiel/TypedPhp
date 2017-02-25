<?php
namespace Mcustiel\TypedPhp\Test\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableStringArray;

class ImmutableStringArrayTest extends ImmutableArrayAsserts
{
    /**
     * @test
     */
    public function shouldFailWhenTryingToAddData()
    {
        $this->assertAddingDataNotAllowed(ImmutableStringArray::class, ['tomato', 'potato'], 'banana');
    }

    /**
     * @test
     */
    public function shouldFailWhenTryingToRemoveData()
    {
        $this->assertRemovingDataNotAllowed(ImmutableStringArray::class, ['tomato', 'potato']);
    }
}
