<?php

namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Types\IntegerValue;
use Mcustiel\TypedPhp\Values\IntegerCreator;

/**
 * @covers \Mcustiel\TypedPhp\Values\IntegerCreator
 * @covers \Mcustiel\TypedPhp\Traits\Creation\SingletonMcustiel\TypedPhp\Test\Types\
 */
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
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a integer value, got: string');
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
    public function shouldClearAllValues()
    {
        $value1 = IntegerCreator::instance()->getValueObject(72);
        IntegerCreator::instance()->clear();
        $value2 = IntegerCreator::instance()->getValueObject(72);
        $this->assertFalse($value1 === $value2);
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
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('The value 72 is not stored');
        IntegerCreator::instance()->removeValue(new IntegerValue(72));
    }
}
