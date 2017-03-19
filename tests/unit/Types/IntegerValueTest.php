<?php

namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\IntegerValue;

/**
 * @covers \Mcustiel\TypedPhp\Types\IntegerValue
 * @covers \Mcustiel\TypedPhp\PrimitiveValueObject
 * @covers \Mcustiel\TypedPhp\Traits\Conversion\ToBooleanConverter
 */
class IntegerValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            'max integer' => [PHP_INT_MAX],
            'positive integer' => [5],
            'zero' => [0],
            'negative integer' => [-5],
            'min integer' => [PHP_INT_MIN],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            'string' => [''],
            'integer as double' => [2.0],
            'double' => [2.2],
            'function' => [function () {
            }],
            'object' => [new \stdClass()],
            'array' => [[]],
            'boolean' => [true],
            'null' => [null],
        ];
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param mixed $validValue
     */
    public function shouldAcceptAIntegerAndReturnIt($validValue)
    {
        $value = new IntegerValue($validValue);
        $this->assertSame($validValue, $value->value());
    }

    /**
     * @test
     * @dataProvider invalidValuesProvider
     *
     * @param mixed $invalidValue
     */
    public function shouldFailIfAnInvalidValueIsGiven($invalidValue)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Expected an integer, got ' . gettype($invalidValue)
        );
        new IntegerValue($invalidValue);
    }

    /**
     * @test
     */
    public function shouldAddCorrectly()
    {
        $value = new IntegerValue(2);
        $this->assertSame(5, $value->add(new IntegerValue(3))->value());
    }

    /**
     * @test
     */
    public function shouldSubstractCorrectly()
    {
        $value = new IntegerValue(3);
        $this->assertSame(1, $value->substract(new IntegerValue(2))->value());
    }

    /**
     * @test
     */
    public function shouldMultiplyCorrectly()
    {
        $value = new IntegerValue(3);
        $this->assertSame(12, $value->multiply(new IntegerValue(4))->value());
    }

    /**
     * @test
     */
    public function shouldDivideCorrectly()
    {
        $value = new IntegerValue(12);
        $this->assertSame(3, $value->divide(new IntegerValue(4))->value());
    }

    /**
     * @test
     */
    public function shouldGetTheModuleCorrectly()
    {
        $value = new IntegerValue(15);
        $this->assertSame(3, $value->module(new IntegerValue(4))->value());
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param mixed $validValue
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
