<?php
namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Types\DoubleValue;

class DoubleCreator
{
    /**
     * @var DoubleValue[]
     */
    private static $values = [];

    /**
     * @param double $value
     * @return DoubleValue
     */
    public static function getValueObject($value)
    {
        self::verifyType($value);
        return self::getValueFromCollection($value);
    }

    /**
     * @param double $value
     * @return DoubleValue
     */
    private static function getValueFromCollection($value)
    {
        $index = number_format($value, 5);
        if (!isset(self::$values[$index])) {
            self::$values[$index] = new DoubleValue($value);
        }
        return self::$values[$index];
    }

    /**
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    private static function verifyType($value)
    {
        if (!is_double($value)) {
            throw new \InvalidArgumentException(
                'Expected a double value, got: ' . gettype($value)
            );
        }
    }
}
