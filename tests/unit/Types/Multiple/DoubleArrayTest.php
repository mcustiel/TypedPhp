<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Types\Multiple\DoubleArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\DoubleArray
 * @covers \Mcustiel\TypedPhp\Types\Multiple\PrimitivesArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class DoubleArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [[0.0]],
            [[1.1, 2.2, 3.3, 4.4, 5.5]],
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
            [[1, 2, 3]],
            [[1.0, 2.0, 3]],
            [[1.0, 2, 3.0]],
            [[1, 2.0, 3.0]],
            [['1.1']],
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
            ['1.2'],
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
        $value = [2.0, 3.1, 4.29];
        $this->assertSame(print_r($value, true), (string) new DoubleArray($value));
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param array $array
     */
    public function shouldCreateCorrectlyWithValidArrays(array $array)
    {
        $arrayValue = new DoubleArray($array);
        $this->assertSame($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValue()
    {
        $array = new DoubleArray([1.0]);
        $array[] = 2.1;
        $this->assertSame([1.0, 2.1], $array->value());
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
        new DoubleArray($value);
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
            'Trying to save an element of an invalid type in an array of double'
        );
        new DoubleArray($value);
    }

    /**
     * @test
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Trying to save an element of an invalid type in an array of double'
        );
        $array = new DoubleArray([1.0]);
        $array[] = 2;
    }
}
