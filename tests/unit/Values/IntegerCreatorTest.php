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
        $value = IntegerCreator::instance()->getValueObject(3);
        $this->assertInstanceOf(IntegerValue::class, $value);
        $this->assertSame(3, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        IntegerCreator::instance()->getValueObject('fail!');
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = IntegerCreator::instance()->getValueObject(3);
        $value2 = IntegerCreator::instance()->getValueObject(3);
        $this->assertSame($value1, $value2);
    }

    /**
     * @before
     */
    public function clearValues()
    {
        IntegerCreator::instance()->clear();
    }

    /**
     * @test
     */
    public function shouldUnsetAValue()
    {
        $value1 = IntegerCreator::instance()->getValueObject(72);
        IntegerCreator::instance()->removeValue($value1);
        $value2 = IntegerCreator::instance()->getValueObject(72);
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        IntegerCreator::instance()->removeValue(new IntegerValue(72));
    }
}