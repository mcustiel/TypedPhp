<?php

namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Types\BooleanValue;
use Mcustiel\TypedPhp\Values\BooleanCreator;

/**
 * @covers \Mcustiel\TypedPhp\Values\BooleanCreator
 * @covers \Mcustiel\TypedPhp\Values\PrimitiveCreator
 * @covers \Mcustiel\TypedPhp\Traits\Creation\Singleton
 */
class BooleanCreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnAValidBooleanValue()
    {
        $value = BooleanCreator::instance()->getValueObject(true);
        $this->assertInstanceOf(BooleanValue::class, $value);
        $this->assertTrue($value->value());
    }

    /**
     * @test
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a boolean value, got: string');

        BooleanCreator::instance()->getValueObject('fail!');
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = BooleanCreator::instance()->getValueObject(true);
        $value2 = BooleanCreator::instance()->getValueObject(true);
        $this->assertSame($value1, $value2);
    }

    /**
     * @before
     */
    public function clearValues()
    {
        BooleanCreator::instance()->clear();
    }

    /**
     * @test
     */
    public function shouldClearAllValues()
    {
        $value1 = BooleanCreator::instance()->getValueObject(true);
        BooleanCreator::instance()->clear();
        $value2 = BooleanCreator::instance()->getValueObject(true);
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     */
    public function shouldUnsetAValue()
    {
        $value1 = BooleanCreator::instance()->getValueObject(true);
        BooleanCreator::instance()->removeValue($value1);
        $value2 = BooleanCreator::instance()->getValueObject(true);
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('The value true is not stored');
        BooleanCreator::instance()->removeValue(new BooleanValue(true));
    }
}
