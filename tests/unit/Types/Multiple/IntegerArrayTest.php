<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Types\Multiple\IntegerArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\IntegerArray
 * @covers \Mcustiel\TypedPhp\Types\Multiple\PrimitivesArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class IntegerArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [[0]],
            [[1, 2, 3, 4, 5]],
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
            [[1, 2, 'c']],
            [[1, 'b', 'c']],
            [['a', 2, 3]],
            [['1']],
            [['0']],
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
     */
    public function shouldConvertToStringCorrectly()
    {
        $value = [1, 0, 2, 3];
        $this->assertSame(print_r($value, true), (string) new IntegerArray($value));
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param array $array
     */
    public function shouldCreateCorrectlyWithValidArrays(array $array)
    {
        $arrayValue = new IntegerArray($array);
        $this->assertSame($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValueAsAnArray()
    {
        $array = new IntegerArray([1]);
        $array[] = 2;
        $this->assertSame([1, 2], $array->value());
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
        new IntegerArray($value);
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
            'Trying to save an element of an invalid type in an array of integer'
        );
        new IntegerArray($value);
    }

    /**
     * @test
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Trying to save an element of an invalid type in an array of integer'
        );
        $array = new IntegerArray([1]);
        $array[] = 'potato';
    }

    /**
     * @test
     */
    public function shouldCountElementsAsAnArray()
    {
        $array = new IntegerArray([1, 2, 3]);
        $this->assertSame(3, count($array));
    }

    /**
     * @test
     */
    public function shouldBeIterableAsForeach()
    {
        $array = new IntegerArray([1, 2, 3]);
        $i = 0;
        foreach ($array as $value) {
            $this->assertSame(++$i, $value);
        }
    }

    /**
     * @test
     */
    public function shouldBeAccessibleAsArray()
    {
        $array = new IntegerArray([1, 2, 3]);
        $element = $array[1];
        $this->assertSame(2, $element);
    }

    /**
     * @test
     */
    public function shoulBeCheckedAsArray()
    {
        $array = new IntegerArray([1, 2, 3]);
        $this->assertTrue(isset($array[1]));
        $this->assertFalse(isset($array[4]));
    }

    /**
     * @test
     */
    public function shoulBeUnsetAsArray()
    {
        $array = new IntegerArray([1, 2, 3]);
        unset($array[1]);
        $this->assertSame([1, 2 => 3], $array->value());
    }

    /**
     * @test
     */
    public function shouldSerializeAndUnserialize()
    {
        $array = new IntegerArray([1, 2, 3]);
        $serialized = serialize($array);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(IntegerArray::class, $unserialized);
        $this->assertSame([1, 2, 3], $unserialized->value());
    }
}
