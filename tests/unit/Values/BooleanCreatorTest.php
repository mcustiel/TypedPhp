<?php
namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Values\BooleanCreator;
use Mcustiel\TypedPhp\Types\BooleanValue;

class BooleanCreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnAValidBooleanValue()
    {
        $value = BooleanCreator::instance()->getValueObject(true);
        $this->assertInstanceOf(BooleanValue::class, $value);
        $this->assertSame(true, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldfailWhenTypeIsNotValid()
    {
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
    public function shouldUnsetAValue()
    {
        $value1 = BooleanCreator::instance()->getValueObject(true);
        BooleanCreator::instance()->removeValue($value1);
        $value2 = BooleanCreator::instance()->getValueObject(true);
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        BooleanCreator::instance()->removeValue(new BooleanValue(true));
    }
}
