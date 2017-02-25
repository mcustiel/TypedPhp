<?php
namespace Mcustiel\TypedPhp\Test\ValueObjects\Multiple;

use Mcustiel\TypedPhp\ValueObjects\Multiple\IntegerArray;

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
        $arrayValue = new IntegerArray($array);
        $this->assertEquals($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValueAsAnArray()
    {
        $array = new IntegerArray([1]);
        $array[] = 2;
        $this->assertEquals([1, 2], $array->value());
    }

    /**
     * @test
     * @dataProvider invalidValuesProvider
     * @param mixed $value
     * @expectedException \TypeError
     */
    public function shouldFailWhenCreatingWithInvalidValues($value)
    {
        new IntegerArray($value);
    }

    /**
     * @test
     * @dataProvider invalidArrayValuesProvider
     * @param mixed $value
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailWithInvalidArrays(array $value)
    {
        new IntegerArray($value);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
        $array = new IntegerArray([1]);
        $array[] = 'potato';
    }

    /**
     * @test
     */
    public function shouldCountElementsAsAnArray()
    {
        $array = new IntegerArray([1, 2, 3]);
        $this->assertEquals(3, count($array));
    }

    /**
     * @test
     */
    public function shouldBeIterableAsForeach()
    {
        $array = new IntegerArray([1, 2, 3]);
        $i = 0;
        foreach ($array as $value) {
            $this->assertEquals(++$i, $value);
        }
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
        $this->assertEquals([1, 2, 3], $unserialized->value());
    }
}
