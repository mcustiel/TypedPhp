<?php
namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Types\Multiple\StringArray;

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
        $arrayValue = new StringArray($array);
        $this->assertEquals($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValue()
    {
        $array = new StringArray(['potato']);
        $array[] = 'tomato';
        $this->assertEquals(['potato', 'tomato'], $array->value());
    }

    /**
     * @test
     * @dataProvider invalidValuesProvider
     * @param mixed $value
     * @expectedException \TypeError
     */
    public function shouldFailWhenCreatingWithInvalidValues($value)
    {
        new StringArray($value);
    }

    /**
     * @test
     * @dataProvider invalidArrayValuesProvider
     * @param mixed $value
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailWithInvalidArrays(array $value)
    {
        new StringArray($value);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
        $array = new StringArray(['potato']);
        $array[] = 1;
    }
}
