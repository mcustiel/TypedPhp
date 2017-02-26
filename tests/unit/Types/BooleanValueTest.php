<?php
namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\BooleanValue;

class BooleanValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [true],
            [false],
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
            [null],
        ];
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     */
    public function shouldAcceptABooleanAndReturnIt($validValue)
    {
        $value = new BooleanValue($validValue);
        $this->assertEquals($validValue, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidValuesProvider
     */
    public function shouldFailIfAnInvalidValueIsGiven($invalidValue)
    {
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
     * @dataProvider validValuesProvider
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
