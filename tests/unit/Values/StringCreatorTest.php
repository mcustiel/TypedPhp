<?php

namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Types\StringValue;
use Mcustiel\TypedPhp\Values\StringCreator;

/**
 * @covers \Mcustiel\TypedPhp\Values\StringCreator
 * @covers \Mcustiel\TypedPhp\Traits\Creation\SingletonMcustiel\TypedPhp\Test\Types\
 */
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
     */
    public function shouldfailWhenTypeIsNotValid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a string value, got: integer');
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
    public function shouldClearAllValues()
    {
        $value1 = StringCreator::instance()->getValueObject('potato');
        StringCreator::instance()->clear();
        $value2 = StringCreator::instance()->getValueObject('potato');
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     */
    public function shouldUnsetAValue()
    {
        $value1 = StringCreator::instance()->getValueObject('potato');
        StringCreator::instance()->removeValue($value1);
        $value2 = StringCreator::instance()->getValueObject('potato');
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('The value potato is not stored');
        StringCreator::instance()->removeValue(new StringValue('potato'));
    }
}
