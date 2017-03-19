<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Types\Multiple\StringArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\StringArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class StringArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [['']],
            [['p', 'o', 't', 'a', 't', 'o']],
            [[]],
        ];
    }

    /**
     * @return array
     */
    public function invalidArrayValuesProvider()
    {
        return [
            [[1, 2, 3]],
            [['a', 'b', 3]],
            [['a', 2, 'c']],
            [[1, 'b', 'c']],
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
            [1],
            [1.2],
            ['string'],
            [true],
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
        $arrayValue = new StringArray($array);
        $this->assertSame($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValue()
    {
        $array = new StringArray(['potato']);
        $array[] = 'tomato';
        $this->assertSame(['potato', 'tomato'], $array->value());
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
        new StringArray($value);
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
            'Trying to save an element of an invalid type in an array of string'
        );
        new StringArray($value);
    }

    /**
     * @test
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Trying to save an element of an invalid type in an array of string'
        );
        $array = new StringArray(['potato']);
        $array[] = 1;
    }
}
