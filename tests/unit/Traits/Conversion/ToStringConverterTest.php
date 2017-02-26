<?php
namespace Mcustiel\TypedPhp\Test\Traits\Conversion;

use Mcustiel\TypedPhp\Traits\Conversion\ToStringConverter;
use Mcustiel\TypedPhp\Types\StringValue;
use Mcustiel\TypedPhp\Types\IntegerValue;
use Mcustiel\TypedPhp\Types\DoubleValue;
use Mcustiel\TypedPhp\Types\BooleanValue;

class ToStringConverterTest extends \PHPUnit_Framework_TestCase
{
    use ToStringConverter;

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
            [new IntegerValue(15), '15'],
            [new IntegerValue(0), '0'],
            [new IntegerValue(-1), '-1'],
            [new DoubleValue(-1.5), '-1.500'],
            [new DoubleValue(0.0), '0.000'],
            [new DoubleValue(1.0), '1.000'],
            [new DoubleValue(1.23), '1.230'],
            [new BooleanValue(true), 'true'],
            [new BooleanValue(false), 'false'],
        ];
    }

    /**
     * @test
     * @dataProvider objectsAndExpectationsProvider
     */
    public function shouldConvertToStringValue($testedObject, $expectedValue)
    {
        $this->testedObject = $testedObject;

        $this->assertInstanceOf(StringValue::class, $this->toStringValue());
        $this->assertSame($expectedValue, $this->toStringValue()->value());
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->testedObject->__toString();
    }
}
