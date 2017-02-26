<?php
namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\Types\StringValue;
use Mcustiel\TypedPhp\ArrayValueObject;
use Mcustiel\TypedPhp\Types\Multiple\StringArray;

class StringValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [''],
            ['abcdefg'],
            ['1234567'],
            ['ÄäÜüÖöññññ'],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            [2.0],
            [2.2],
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
    public function shouldAcceptAStringAndReturnIt($validValue)
    {
        $value = new StringValue($validValue);
        $this->assertEquals($validValue, $value->value());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidValuesProvider
     */
    public function shouldFailIfAnInvalidValueIsGiven($invalidValue)
    {
        new StringValue($invalidValue);
    }

    /**
     * @test
     */
    public function shouldConvertToString()
    {
        $value = new StringValue('15');
        $this->assertEquals('15', (string) $value);
    }

    /**
     * @test
     */
    public function shouldReverseTheString()
    {
        $value = new StringValue('potato');
        $this->assertSame('otatop', $value->reverse()->value());
    }

    /**
     * @test
     */
    public function shouldReplace()
    {
        $value = new StringValue('potato');
        $this->assertEquals(new StringValue('papa'), $value->replace($value, new StringValue('papa')));
    }

    /**
     * @test
     */
    public function shouldCompareDirectlyToAString()
    {
        $value = new StringValue('potato');
        $this->assertEquals('potato', $value);
    }

    /**
     * @test
     */
    public function shouldImplodeAnArray()
    {
        $array = $this->createMock(ArrayValueObject::class);
        $array->expects($this->once())
            ->method('value')
            ->willReturn(['p', 'o', 't', 'a', 't', 'o']);
        $result = StringValue::implode(new StringValue('.'), $array);
        $this->assertInstanceOf(StringValue::class, $result);
        $this->assertEquals('p.o.t.a.t.o', $result);
    }

    /**
     * @test
     */
    public function shouldExplodeToAnArray()
    {
        $value = new StringValue('p.o.t.a.t.o');
        $result = $value->explode(new StringValue('.'));
        $this->assertInstanceOf(StringArray::class, $result);
        $this->assertEquals(['p', 'o', 't', 'a', 't', 'o'], $result->value());
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     */
    public function shouldSerializeAndUnserialize($validValue)
    {
        $value = new StringValue($validValue);
        $serialized = serialize($value);
        $unserialized = unserialize($serialized);
        $this->assertInstanceOf(StringValue::class, $unserialized);
        $this->assertSame($validValue, $unserialized->value());
    }
}
