<?php
namespace Mcustiel\TypedPhp\Test\ValueObjects;

use Mcustiel\TypedPhp\ValueObjects\StringValue;
use Mcustiel\TypedPhp\ValueObjects\DoubleValue;
use Mcustiel\TypedPhp\ValueObjects\IntegerValue;
use Mcustiel\TypedPhp\ArrayValueObject;
use Mcustiel\TypedPhp\ValueObjects\Multiple\StringArray;

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
    public function shouldAcceptADoubleAndReturnIt($validValue)
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
    public function shouldConvertToDouble()
    {
        $value = new StringValue('15.1');
        $this->assertInternalType('double', $value->toDouble());
        $this->assertSame(15.1, $value->toDouble());
    }

    /**
     * @test
     */
    public function shouldConvertToInteger()
    {
        $value = new StringValue('15');
        $this->assertInternalType('integer', $value->toInteger());
        $this->assertSame(15, $value->toInteger());
    }

    /**
     * @test
     */
    public function shouldConvertToDoubleValueObject()
    {
        $value = new StringValue('15');
        $this->assertEquals(new DoubleValue(15.0), $value->toDoubleValue());
    }

    /**
     * @test
     */
    public function shouldConvertEmptyToDoubleValueObject()
    {
        $value = new StringValue('');
        $this->assertEquals(new DoubleValue(0.0), $value->toDoubleValue());
    }

    /**
     * @test
     */
    public function shouldConvertToIntegerValueObject()
    {
        $value = new StringValue('15');
        $this->assertEquals(new IntegerValue(15), $value->toIntegerValue());
    }

    /**
     * @test
     */
    public function shouldConvertEmptyToIntegerValueObject()
    {
        $value = new StringValue('');
        $this->assertEquals(new IntegerValue(0), $value->toIntegerValue());
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
}
