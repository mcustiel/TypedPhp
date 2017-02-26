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
        $value = BooleanCreator::getValueObject(true);
        $this->assertInstanceOf(BooleanValue::class, $value);
        $this->assertSame(true, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        BooleanCreator::getValueObject('fail!');
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = BooleanCreator::getValueObject(true);
        $value2 = BooleanCreator::getValueObject(true);
        $this->assertSame($value1, $value2);
    }
}
