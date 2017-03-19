<?php

namespace Mcustiel\TypedPhp\Test\Types;

use Mcustiel\TypedPhp\ArrayValueObject;
use Mcustiel\TypedPhp\Types\Multiple\StringArray;
use Mcustiel\TypedPhp\Types\StringValue;

/**
 * @covers \Mcustiel\TypedPhp\Types\StringValue
 * @covers \Mcustiel\TypedPhp\PrimitiveValueObject
 */
class StringValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            'empty string' => [''],
            'alpha string' => ['abcdefg'],
            'numeric string' => ['1234567'],
            'alphanumeric string' => ['abcdefg1234567'],
            'non standard chars string' => ['ÄäÜüÖöññññ'],
        ];
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            'integer' => [2],
            'double' => [2.2],
            'function' => [function () {
            }],
            'object' => [new \stdClass()],
            'array' => [[]],
            'boolean' => [true],
            'null' => [null],
        ];
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param mixed $validValue
     */
    public function shouldAcceptAStringAndReturnIt($validValue)
    {
        $value = new StringValue($validValue);
        $this->assertSame($validValue, $value->value());
    }

    /**
     * @test
     * @dataProvider invalidValuesProvider
     *
     * @param mixed $invalidValue
     */
    public function shouldFailIfAnInvalidValueIsGiven($invalidValue)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Expected a string, got %s', gettype($invalidValue))
        );
        new StringValue($invalidValue);
    }

    /**
     * @test
     */
    public function shouldConvertToString()
    {
        $value = new StringValue('15');
        $this->assertSame('15', (string) $value);
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
        $this->assertSame(
            (new StringValue('papa'))->value(),
            $value->replace($value, new StringValue('papa'))->value()
        );
    }

    /**
     * @test
     */
    public function shouldCompareDirectlyToAString()
    {
        $value = new StringValue('potato');
        $this->assertSame('potato', (string) $value);
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
        $this->assertSame('p.o.t.a.t.o', $result->value());
    }

    /**
     * @test
     */
    public function shouldExplodeToAnArray()
    {
        $value = new StringValue('p.o.t.a.t.o');
        $result = $value->explode(new StringValue('.'));
        $this->assertInstanceOf(StringArray::class, $result);
        $this->assertSame(['p', 'o', 't', 'a', 't', 'o'], $result->value());
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param mixed $validValue
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
