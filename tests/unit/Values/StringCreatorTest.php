<?php
namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Values\StringCreator;
use Mcustiel\TypedPhp\Types\StringValue;

class StringCreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnAValidStringValue()
    {
        $value = StringCreator::instance()->getValueObject('potato');
        $this->assertInstanceOf(StringValue::class, $value);
        $this->assertSame('potato', $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        StringCreator::instance()->getValueObject(55);
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = StringCreator::instance()->getValueObject('potato');
        $value2 = StringCreator::instance()->getValueObject('potato');
        $this->assertSame($value1, $value2);
    }

    /**
     * @before
     */
    public function clearValues()
    {
        StringCreator::instance()->clear();
    }

    /**
     * @test
     */
    public function shouldUnsetAValue()
    {
        $value1 = StringCreator::instance()->getValueObject('poato');
        StringCreator::instance()->removeValue($value1);
        $value2 = StringCreator::instance()->getValueObject('poato');
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        StringCreator::instance()->removeValue(new StringValue('poato'));
    }
}
