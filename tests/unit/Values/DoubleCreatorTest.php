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
        $value = DoubleCreator::getValueObject(3.765);
        $this->assertInstanceOf(DoubleValue::class, $value);
        $this->assertSame(3.765, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        DoubleCreator::getValueObject('fail!');
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = DoubleCreator::getValueObject(3.765);
        $value2 = DoubleCreator::getValueObject(3.765);
        $this->assertSame($value1, $value2);
    }
}
