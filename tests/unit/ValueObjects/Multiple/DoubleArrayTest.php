<?php
namespace Mcustiel\TypedPhp\Test\ValueObjects\Multiple;

use Mcustiel\TypedPhp\ValueObjects\Multiple\DoubleArray;

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
            [1.2],
            ['string'],
            [function () {
            }],
            [new \stdClass()]
        ];
    }


    /**
     * @test
     * @dataProvider validValuesProvider
     * @param array $array
     */
    public function shouldCreateCorrectlyWithValidArrays(array $array)
    {
        $arrayValue = new DoubleArray($array);
        $this->assertEquals($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValue()
    {
        $array = new DoubleArray([1.0]);
        $array[] = 2.1;
        $this->assertEquals([1.0, 2.1], $array->value());
    }

    /**
     * @test
     * @dataProvider invalidValuesProvider
     * @param mixed $value
     * @expectedException \TypeError
     */
    public function shouldFailWhenCreatingWithInvalidValues($value)
    {
        new DoubleArray($value);
    }

    /**
     * @test
     * @dataProvider invalidArrayValuesProvider
     * @param mixed $value
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailWithInvalidArrays(array $value)
    {
        new DoubleArray($value);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
        $array = new DoubleArray([1.0]);
        $array[] = 2;
    }
}
