<?php

namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Types\DoubleValue;
use Mcustiel\TypedPhp\Values\DoubleCreator;

/**
 * @covers \Mcustiel\TypedPhp\Values\DoubleCreator
 * @covers \Mcustiel\Traits\Creation\Singleton
 */
class DoubleCreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnAValidDoubleValue()
    {
        $value = DoubleCreator::instance()->getValueObject(3.765);
        $this->assertInstanceOf(DoubleValue::class, $value);
        $this->assertSame(3.765, $value->value());
    }

    /**
     * @test
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a double value, got: string');
        DoubleCreator::instance()->getValueObject('fail!');
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = DoubleCreator::instance()->getValueObject(3.765);
        $value2 = DoubleCreator::instance()->getValueObject(3.765);
        $this->assertSame($value1, $value2);
    }

    /**
     * @before
     */
    public function clearValues()
    {
        DoubleCreator::instance()->clear();
    }

    /**
     * @test
     */
    public function shouldClearAllValues()
    {
        $value1 = DoubleCreator::instance()->getValueObject(7.2);
        DoubleCreator::instance()->clear();
        $value2 = DoubleCreator::instance()->getValueObject(7.2);
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     */
    public function shouldUnsetAValue()
    {
        $value1 = DoubleCreator::instance()->getValueObject(7.2);
        DoubleCreator::instance()->removeValue($value1);
        $value2 = DoubleCreator::instance()->getValueObject(7.2);
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('The value 7.200 is not stored');
        DoubleCreator::instance()->removeValue(new DoubleValue(7.2));
    }
}
