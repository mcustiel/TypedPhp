<?php

namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\DoubleValue;

/**
 * @covers \Mcustiel\TypedPhp\Types\DoubleValue
 * @covers \Mcustiel\TypedPhp\PrimitiveValueObject
 */
class DoubleValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            'positive double as integer' => [5.0],
            'positive pure double' => [5.123],
            'zero as double' => [0.0],
            'negative double as integer' => [-5.0],
            'negative pure double' => [-5.5],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            'integer' => [2],
            'string' => [''],
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
    public function shouldAcceptADoubleAndReturnIt($validValue)
    {
        $value = new DoubleValue($validValue);
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
            'Expected a double, got ' . gettype($invalidValue)
        );
        new DoubleValue($invalidValue);
    }

    /**
     * @test
     */
    public function shouldAddCorrectly()
    {
        $value = new DoubleValue(2.1);
        $this->assertSame(5.1, $value->add(new DoubleValue(3.0))->value());
    }

    /**
     * @test
     */
    public function shouldSubstractCorrectly()
    {
        $value = new DoubleValue(3.0);
        $this->assertSame(1.0, $value->substract(new DoubleValue(2.0))->value());
    }

    /**
     * @test
     */
    public function shouldMultiplyCorrectly()
    {
        $value = new DoubleValue(3.0);
        $this->assertSame(12.6, $value->multiply(new DoubleValue(4.2))->value());
    }

    /**
     * @test
     */
    public function shouldDivideCorrectly()
    {
        $value = new DoubleValue(12.6);
        $this->assertSame(3.0, $value->divide(new DoubleValue(4.2))->value());
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param mixed $validValue
     */
    public function shouldSerializeAndUnserialize($validValue)
    {
        $value = new DoubleValue($validValue);
        $serialized = serialize($value);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(DoubleValue::class, $unserialized);
        $this->assertSame($validValue, $unserialized->value());
    }
}
