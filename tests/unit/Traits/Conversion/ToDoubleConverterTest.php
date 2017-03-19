<?php

namespace Mcustiel\TypedPhp\Test\Traits\Conversion;

use Mcustiel\TypedPhp\Traits\Conversion\ToDoubleConverter;
use Mcustiel\TypedPhp\Types\BooleanValue;
use Mcustiel\TypedPhp\Types\DoubleValue;
use Mcustiel\TypedPhp\Types\IntegerValue;
use Mcustiel\TypedPhp\Types\StringValue;

/**
 * @covers \Mcustiel\TypedPhp\Traits\Conversion\ToDoubleConverter
 */
class ToDoubleConverterTest extends \PHPUnit_Framework_TestCase
{
    use ToDoubleConverter;

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
            [new IntegerValue(15), 15.0],
            [new IntegerValue(0), 0.0],
            [new IntegerValue(-1), -1.0],
            [new StringValue(''), 0.0],
            [new StringValue('potato'), 0.0],
            [new StringValue('3.2'), 3.2],
            [new BooleanValue(true), 1.0],
            [new BooleanValue(false), 0.0],
        ];
    }

    /**
     * @test
     * @dataProvider objectsAndExpectationsProvider
     *
     * @param mixed $testedObject
     * @param mixed $expectedValue
     */
    public function shouldConvertToDoubleValue($testedObject, $expectedValue)
    {
        $this->testedObject = $testedObject;

        $this->assertInstanceOf(DoubleValue::class, $this->toDoubleValue());
        $this->assertSame($expectedValue, $this->toDoubleValue()->value());
    }

    /**
     * @test
     * @dataProvider objectsAndExpectationsProvider
     *
     * @param mixed $testedObject
     * @param mixed $expectedValue
     */
    public function shouldConvertToDouble($testedObject, $expectedValue)
    {
        $this->testedObject = $testedObject;

        $this->assertInternalType('double', $this->toDouble());
        $this->assertSame($expectedValue, $this->toDouble());
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->testedObject->value();
    }
}
