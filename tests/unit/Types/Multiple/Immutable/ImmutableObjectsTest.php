<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple\Immutable;

use Mcustiel\TypedPhp\Test\Fixtures\Foo;
use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableObjectsArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableObjectsArray
 * @covers \Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutablePrimitivesArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class ImmutableObjectsTest extends ImmutableArrayAsserts
{
    /**
     * @test
     */
    public function shouldFailWhenTryingToAddData()
    {
        $this->expectException(\RuntimeException::class);
        $array = new ImmutableObjectsArray(Foo::class, [new Foo(), new Foo()]);
        $array[] = new Foo();
    }

    /**
     * @test
     */
    public function shouldFailWhenTryingToRemoveData()
    {
        $this->expectException(\RuntimeException::class);
        $array = new ImmutableObjectsArray(Foo::class, [new Foo(), new Foo()]);
        unset($array[0]);
    }
}
