<?php
namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\IntegerValue;

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
    public function shouldAcceptAIntegerAndReturnIt($validValue)
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
    public function shouldGetTheModuleCorrectly()
    {
        $value = new IntegerValue(15);
        $this->assertEquals(3, $value->module(new IntegerValue(4))->value());
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     */
    public function shouldSerializeAndUnserialize($validValue)
    {
        $value = new IntegerValue($validValue);
        $serialized = serialize($value);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(IntegerValue::class, $unserialized);
        $this->assertSame($validValue, $unserialized->value());
    }
}
