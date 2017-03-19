<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Test\Fixtures\Bar;
use Mcustiel\TypedPhp\Test\Fixtures\Foo;
use Mcustiel\TypedPhp\Types\Multiple\ObjectsArray;
use Mcustiel\TypedPhp\Types\StringValue;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\ObjectsArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class ObjectsArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function invalidClassNamesProvider()
    {
        return [
            ['potato'],
            ['\\I\\Am\\A\\Class\\That\\Does\\Not\\Exist'],
            [1],
            [null],
            [5.5],
        ];
    }

    /**
     * @return array
     */
    public function validClassNamesProvider()
    {
        return [
            [\stdClass::class],
            [Foo::class],
            [Bar::class],
            [StringValue::class],
        ];
    }

    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            [[new Foo()]],
            [[new Foo(), new Foo()]],
            [[new Foo(), new Foo(), new Foo()]],
            [[new Bar(), new Bar()]],
            [[]],
        ];
    }

    /**
     * @return array
     */
    public function invalidArrayValuesProvider()
    {
        return [
            [[new \stdClass()]],
            [[new Foo(), new \stdClass()]],
            [[new \stdClass(), new Foo()]],
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
            [new \stdClass()],
        ];
    }

    /**
     * @test
     * @dataProvider invalidClassNamesProvider
     *
     * @param mixed $type
     */
    public function shouldFailWhenGivingAnIncorrectType($type)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Expected a class name, got ' . (string) $type
        );
        new ObjectsArray($type, []);
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
        new ObjectsArray(Foo::class, $value);
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
            'Trying to save an element of an invalid type in an array of Mcustiel\TypedPhp\Test\Fixtures\Foo'
        );
        new ObjectsArray(Foo::class, $value);
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     *
     * @param array $array
     */
    public function shouldCreateCorrectlyWithValidArrays(array $array)
    {
        $arrayValue = new ObjectsArray(Foo::class, $array);
        $this->assertSame($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValue()
    {
        $foo1 = new Foo();
        $foo2 = new Foo();
        $array = new ObjectsArray(Foo::class, [$foo1]);
        $array[] = $foo2;
        $this->assertSame([$foo1, $foo2], $array->value());
    }
}
