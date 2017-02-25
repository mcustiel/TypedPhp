<?php
namespace Mcustiel\TypedPhp\Test\ValueObjects;

use Mcustiel\TypedPhp\ValueObjects\IntegerValue;
use Mcustiel\TypedPhp\ValueObjects\DoubleValue;

class IntegerValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [PHP_INT_MAX],
            [5],
            [0],
            [-5],
            [PHP_INT_MIN],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            [''],
            [2.0],
            [2.2],
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
        $value = new IntegerValue($validValue);
        $this->assertEquals($validValue, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidValuesProvider
     */
    public function shouldFailIfAnInvalidValueIsGiven($invalidValue)
    {
        new IntegerValue($invalidValue);
    }

    /**
     * @test
     */
    public function shouldAddCorrectly()
    {
        $value = new IntegerValue(2);
        $this->assertEquals(5, $value->add(new IntegerValue(3))->value());
    }

    /**
     * @test
     */
    public function shouldSubstractCorrectly()
    {
        $value = new IntegerValue(3);
        $this->assertEquals(1, $value->substract(new IntegerValue(2))->value());
    }

    /**
     * @test
     */
    public function shouldMultiplyCorrectly()
    {
        $value = new IntegerValue(3);
        $this->assertEquals(12, $value->multiply(new IntegerValue(4))->value());
    }

    /**
     * @test
     */
    public function shouldDivideCorrectly()
    {
        $value = new IntegerValue(12);
        $this->assertEquals(3, $value->divide(new IntegerValue(4))->value());
    }

    /**
     * @test
     */
    public function shouldConvertToString()
    {
        $value = new IntegerValue(15);
        $this->assertEquals('15', (string) $value);
    }

    /**
     * @test
     */
    public function shouldConvertToDouble()
    {
        $value = new IntegerValue(15);
        $this->assertInternalType('double', $value->toDouble());
        $this->assertSame(15.0, $value->toDouble());
    }

    /**
     * @test
     */
    public function shouldConvertToDoubleValueObject()
    {
        $value = new IntegerValue(15);
        $this->assertEquals(new DoubleValue(15.0), $value->toDoubleValue());
    }
}
