<?php
namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Types\Multiple\BooleanArray;

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
        $arrayValue = new BooleanArray($array);
        $this->assertEquals($array, $arrayValue->value());
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
     * @param mixed $value
     * @expectedException \TypeError
     */
    public function shouldFailWhenCreatingWithInvalidValues($value)
    {
        new BooleanArray($value);
    }

    /**
     * @test
     * @dataProvider invalidArrayValuesProvider
     * @param mixed $value
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailWithInvalidArrays(array $value)
    {
        new BooleanArray($value);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailIfTryToAddAnInvalidValue()
    {
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
    public function shouldSerializeAndUnserialize()
    {
        $array = new BooleanArray([true, false, true]);
        $serialized = serialize($array);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(BooleanArray::class, $unserialized);
        $this->assertSame([true, false, true], $unserialized->value());
    }
}
