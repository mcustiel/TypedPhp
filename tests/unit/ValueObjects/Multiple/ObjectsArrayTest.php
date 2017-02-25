<?php
namespace Mcustiel\TypedPhp\Test\ValueObjects\Multiple;

use Mcustiel\TypedPhp\ValueObjects\Multiple\ObjectsArray;
use Mcustiel\TypedPhp\Test\Fixtures\Foo;
use Mcustiel\TypedPhp\ValueObjects\StringValue;
use Mcustiel\TypedPhp\Test\Fixtures\Bar;

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
            [StringValue::class]
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
            [new \stdClass()]
        ];
    }

    /**
     * @test
     * @dataProvider invalidClassNamesProvider
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailWhenGivingAnIncorrectType($type)
    {
        new ObjectsArray($type, []);
    }

    /**
     * @test
     * @dataProvider invalidValuesProvider
     * @param mixed $value
     * @expectedException \TypeError
     */
    public function shouldFailWhenCreatingWithInvalidValues($value)
    {
        new ObjectsArray(Foo::class, $value);
    }

    /**
     * @test
     * @dataProvider invalidArrayValuesProvider
     * @param mixed $value
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailWithInvalidArrays(array $value)
    {
        new ObjectsArray(Foo::class, $value);
    }

    /**
     * @test
     * @dataProvider validValuesProvider
     * @param array $array
     */
    public function shouldCreateCorrectlyWithValidArrays(array $array)
    {
        $arrayValue = new ObjectsArray(Foo::class, $array);
        $this->assertEquals($array, $arrayValue->value());
    }

    /**
     * @test
     */
    public function shouldWorkWhenAddingWithValidValue()
    {
        $array = new ObjectsArray(Foo::class, [new Foo()]);
        $array[] = new Foo();
        $this->assertEquals([new Foo(), new Foo()], $array->value());
    }
}
