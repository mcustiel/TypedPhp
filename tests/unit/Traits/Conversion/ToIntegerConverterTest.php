<?php

namespace Mcustiel\TypedPhp\Test\Traits\Conversion;

use Mcustiel\TypedPhp\Traits\Conversion\ToIntegerConverter;
use Mcustiel\TypedPhp\Types\BooleanValue;
use Mcustiel\TypedPhp\Types\DoubleValue;
use Mcustiel\TypedPhp\Types\IntegerValue;
use Mcustiel\TypedPhp\Types\StringValue;

/**
 * @covers \Mcustiel\TypedPhp\Traits\Conversion\ToIntegerConverter
 */
class ToIntegerConverterTest extends \PHPUnit_Framework_TestCase
{
    use ToIntegerConverter;

    /**
     * @var \Mcustiel\TypedPhp\Primitive
     */
    private $testedObject;

    /**
     * @return array
     */
    public function objectsAndExpectationsProvider()
    {
        return [
            [new DoubleValue(15.1), 15],
            [new DoubleValue(0.0), 0],
            [new DoubleValue(-1.0), -1],
            [new StringValue(''), 0],
            [new StringValue('potato'), 0],
            [new StringValue('1'), 1],
            [new BooleanValue(true), 1],
            [new BooleanValue(false), 0],
        ];
    }

    /**
     * @test
     * @dataProvider objectsAndExpectationsProvider
     *
     * @param mixed $testedObject
     * @param mixed $expectedValue
     */
    public function shouldConvertToIntegerValue($testedObject, $expectedValue)
    {
        $this->testedObject = $testedObject;

        $this->assertInstanceOf(IntegerValue::class, $this->toIntegerValue());
        $this->assertSame($expectedValue, $this->toIntegerValue()->value());
    }

    /**
     * @test
     * @dataProvider objectsAndExpectationsProvider
     *
     * @param mixed $testedObject
     * @param mixed $expectedValue
     */
    public function shouldConvertToInteger($testedObject, $expectedValue)
    {
        $this->testedObject = $testedObject;

        $this->assertInternalType('integer', $this->toInteger());
        $this->assertSame($expectedValue, $this->toInteger());
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->testedObject->value();
    }
}
