<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Types\Multiple\BooleanArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\BooleanArray
 * @covers \Mcustiel\TypedPhp\Types\Multiple\PrimitivesArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class BooleanArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [[false]],
            [[true, false, true, true, false, true, false, false]],
            [[]],
        ];
    }

    /**
     * @return array
     */
    public function invalidArrayValuesProvider()
    {
        return [
            [['p', 'o', 't', 'a', 't', 'o']],
            [[true, false, 0]],
            [[1, false, true]],
            [[true, 0, false]],
            [['1']],
            [['false']],
            [[[]]],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            [null],
            ['1'],
            [1],
            [true],
            [1.2],
            ['string'],
            [function () {
            }],
            [new \stdClass()],
        ];
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param array $array
     */
    public function shouldCreateCorrectlyWithValidArrays(array $array)
    {
        $arrayValue = new BooleanArray($array);
        $this->assertSame($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValueAsAnArray()
    {
        $array = new BooleanArray([true, false]);
        $array[] = true;
        $this->assertSame([true, false, true], $array->value());
    }

    /**
     * @test
     * @dataProvider invalidValuesProvider
     *
     * @param mixed $value
     */
    public function shouldFailWhenCreatingWithInvalidValues($value)
    {
        $this->expectException(\TypeError::class);
        new BooleanArray($value);
    }

    /**
     * @test
     * @dataProvider invalidArrayValuesProvider
     *
     * @param mixed $value
     */
    public function shouldFailWithInvalidArrays(array $value)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Trying to save an element of an invalid type in an array of boolean'
        );
        new BooleanArray($value);
    }

    /**
     * @test
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Trying to save an element of an invalid type in an array of boolean'
        );
        $array = new BooleanArray([true]);
        $array[] = 'potato';
    }

    /**
     * @test
     */
    public function shouldCountElementsAsAnArray()
    {
        $array = new BooleanArray([true, false, false]);
        $this->assertSame(3, count($array));
    }

    /**
     * @test
     */
    public function shouldBeAccessibleAsArray()
    {
        $array = new BooleanArray([true, false]);
        $element = $array[1];
        $this->assertSame(false, $element);
    }

    /**
     * @test
     */
    public function shouldConvertToStringCorrectly()
    {
        $value = [true, false, true];
        $this->assertSame(print_r($value, true), (string) new BooleanArray($value));
    }

    /**
     * @test
     */
    public function shouldSerializeAndUnserialize()
    {
        $array = new BooleanArray([true, false, true]);
        $serialized = serialize($array);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(BooleanArray::class, $unserialized);
        $this->assertSame([true, false, true], $unserialized->value());
    }
}
