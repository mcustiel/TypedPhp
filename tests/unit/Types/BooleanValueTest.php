<?php

namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\BooleanValue;

/**
 * @covers \Mcustiel\TypedPhp\Types\BooleanValue
 * @covers \Mcustiel\TypedPhp\PrimitiveValueObject
 */
class BooleanValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            'true' => [true],
            'false' => [false],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            'integer' => [2],
            'double' => [2.2],
            'function' => [function () {
            }],
            'object' => [new \stdClass()],
            'array' => [[]],
            'string' => [''],
            'null' => [null],
        ];
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param mixed $validValue
     */
    public function shouldAcceptABooleanAndReturnIt($validValue)
    {
        $value = new BooleanValue($validValue);
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
            'Expected a boolean, got ' . gettype($invalidValue)
        );
        new BooleanValue($invalidValue);
    }

    /**
     * @test
     */
    public function shoulReturnTheResultOfAndOperation()
    {
        $value = new BooleanValue(true);
        $this->assertTrue($value->and(new BooleanValue(true))->value());
        $this->assertFalse($value->and(new BooleanValue(false))->value());
    }

    /**
     * @test
     */
    public function shoulReturnTheResultOfOrOperation()
    {
        $value = new BooleanValue(false);
        $this->assertTrue($value->or(new BooleanValue(true))->value());
        $this->assertFalse($value->or(new BooleanValue(false))->value());
    }

    /**
     * @test
     */
    public function shoulReturnTheResultOfXorOperation()
    {
        $value = new BooleanValue(false);
        $this->assertTrue($value->xor(new BooleanValue(true))->value());
        $this->assertFalse($value->xor(new BooleanValue(false))->value());
    }

    /**
     * @test
     */
    public function shoulReturnTheResultOfNotOperation()
    {
        $this->assertTrue((new BooleanValue(false))->not()->value());
        $this->assertFalse((new BooleanValue(true))->not()->value());
    }

    /**
     * @test
     */
    public function shoulConvertToStringInAReadableWay()
    {
        $this->assertSame('true', (string) new BooleanValue(true));
        $this->assertSame('false', (string) new BooleanValue(false));
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param mixed $validValue
     */
    public function shouldSerializeAndUnserialize($validValue)
    {
        $value = new BooleanValue($validValue);
        $serialized = serialize($value);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(BooleanValue::class, $unserialized);
        $this->assertSame($validValue, $unserialized->value());
    }
}
