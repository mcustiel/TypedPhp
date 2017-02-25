<?php
namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\DoubleValue;
use Mcustiel\TypedPhp\Types\IntegerValue;

class DoubleValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [5.0],
            [0.0],
            [-5.0],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            [''],
            [2],
            [function () {
            }],
            [new \stdClass()],
            [[]],
        ];
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     */
    public function shouldAcceptADoubleAndReturnIt($validValue)
    {
        $value = new DoubleValue($validValue);
        $this->assertEquals($validValue, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidValuesProvider
     */
    public function shouldFailIfAnInvalidValueIsGiven($invalidValue)
    {
        new DoubleValue($invalidValue);
    }

    /**
     * @test
     */
    public function shouldAddCorrectly()
    {
        $value = new DoubleValue(2.1);
        $this->assertEquals(5.1, $value->add(new DoubleValue(3.0))->value());
    }

    /**
     * @test
     */
    public function shouldSubstractCorrectly()
    {
        $value = new DoubleValue(3.0);
        $this->assertEquals(1.0, $value->substract(new DoubleValue(2.0))->value());
    }

    /**
     * @test
     */
    public function shouldMultiplyCorrectly()
    {
        $value = new DoubleValue(3.0);
        $this->assertEquals(12.6, $value->multiply(new DoubleValue(4.2))->value());
    }

    /**
     * @test
     */
    public function shouldDivideCorrectly()
    {
        $value = new DoubleValue(12.6);
        $this->assertEquals(3.0, $value->divide(new DoubleValue(4.2))->value());
    }

    /**
     * @test
     */
    public function shouldConvertToString()
    {
        $value = new DoubleValue(15.0);
        $this->assertEquals('15.0', (string) $value);
    }

    /**
     * @test
     */
    public function shouldConvertToInteger()
    {
        $value = new DoubleValue(15.0);
        $this->assertInternalType('integer', $value->toInteger());
        $this->assertSame(15, $value->toInteger());
    }

    /**
     * @test
     */
    public function shouldConvertToIntegerValueObject()
    {
        $value = new DoubleValue(15.0);
        $this->assertEquals(new IntegerValue(15), $value->toIntegerValue());
    }
}
