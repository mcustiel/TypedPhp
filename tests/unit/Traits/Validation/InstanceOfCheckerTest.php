<?php

namespace Mcustiel\TypedPhp\Test\Traits\Conversion;

use Mcustiel\TypedPhp\Traits\Validation\InstanceOfChecker;
use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableBooleanArray;
use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableIntegerArray;

/**
 * @covers \Mcustiel\TypedPhp\Traits\Validation\InstanceOfChecker
 */
class InstanceOfCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnTrueIfTheObjectValidates()
    {
        $this->assertTrue(
            (new InstanceOfValidator())->isInstanceOf(
                new ImmutableBooleanArray(),
                ImmutableBooleanArray::class
            )
        );
    }

    /**
     * @test
     */
    public function shouldReturnFalseIfTheObjectDoesNotValidate()
    {
        $this->assertFalse(
            (new InstanceOfValidator())->isInstanceOf(
                new ImmutableBooleanArray(),
                ImmutableIntegerArray::class
            )
        );
    }
}

class InstanceOfValidator
{
    use InstanceOfChecker {
        isInstanceOf as public;
    }
}
