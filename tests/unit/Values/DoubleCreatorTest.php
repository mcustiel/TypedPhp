<?php
namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Values\DoubleCreator;
use Mcustiel\TypedPhp\Types\DoubleValue;

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
     * @expectedException \InvalidArgumentException
     */
    public function shouldfailWhenTypeIsNotValid()
    {
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
    public function shouldUnsetAValue()
    {
        $value1 = DoubleCreator::instance()->getValueObject(7.2);
        DoubleCreator::instance()->removeValue($value1);
        $value2 = DoubleCreator::instance()->getValueObject(7.2);
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        DoubleCreator::instance()->removeValue(new DoubleValue(7.2));
    }
}
