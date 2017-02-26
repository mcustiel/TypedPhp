<?php
namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Values\IntegerCreator;
use Mcustiel\TypedPhp\Types\IntegerValue;

class IntegerCreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnAValidIntegerValue()
    {
        $value = IntegerCreator::getValueObject(3);
        $this->assertInstanceOf(IntegerValue::class, $value);
        $this->assertSame(3, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        IntegerCreator::getValueObject('fail!');
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = IntegerCreator::getValueObject(3);
        $value2 = IntegerCreator::getValueObject(3);
        $this->assertSame($value1, $value2);
    }
}
