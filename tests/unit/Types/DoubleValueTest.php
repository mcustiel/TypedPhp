<?php
namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\DoubleValue;

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
     * @dataProvider validValuesProvider
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
