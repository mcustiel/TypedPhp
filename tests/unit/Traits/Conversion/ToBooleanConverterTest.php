<?php
namespace Mcustiel\TypedPhp\Test\Traits\Conversion;

use Mcustiel\TypedPhp\Primitive;
use Mcustiel\TypedPhp\Types\DoubleValue;
use Mcustiel\TypedPhp\Traits\Conversion\ToBooleanConverter;
use Mcustiel\TypedPhp\Types\BooleanValue;
use Mcustiel\TypedPhp\Types\IntegerValue;
use Mcustiel\TypedPhp\Types\StringValue;

class ToBooleanConverterTest extends \PHPUnit_Framework_TestCase
{
    use ToBooleanConverter;

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
            [new IntegerValue(15), true],
            [new IntegerValue(0), false],
            [new IntegerValue(-1), true],
            [new DoubleValue(-1.5), true],
            [new DoubleValue(0.0), false],
            [new DoubleValue(1.23), true],
            [new StringValue(''), false],
            [new StringValue('tomato'), true],
        ];
    }

    /**
     * @test
     * @dataProvider objectsAndExpectationsProvider
     */

    public function shouldConvertToBooleanValue($testedObject, $expectedValue)
    {
        $this->testedObject = $testedObject;

        $this->assertInstanceOf(BooleanValue::class, $this->toBooleanValue());
        $this->assertSame($expectedValue, $this->toBooleanValue()->value());
    }

    /**
     * @test
     * @dataProvider objectsAndExpectationsProvider
     */
    public function shouldConvertToBoolean($testedObject, $expectedValue)
    {
        $this->testedObject = $testedObject;

        $this->assertInternalType('boolean', $this->toBoolean());
        $this->assertSame($expectedValue, $this->toBoolean());
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->testedObject->value();
    }
}
