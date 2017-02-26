<?php
namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Types\IntegerValue;

class IntegerCreator
{
    /**
     * @var IntegerValue[]
     */
    private static $values = [];

    /**
     * @param integer $value
     * @return IntegerValue
     */
    public static function getValueObject($value)
    {
        self::verifyType($value);
        return self::getValueFromCollection($value);
    }

    /**
     * @param integer $value
     * @return IntegerValue
     */
    private static function getValueFromCollection($value)
    {
        $index = (string) $value;
        if (!isset(self::$values[$index])) {
            self::$values[$index] = new IntegerValue($value);
        }
        return self::$values[$index];
    }

    /**
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    private static function verifyType($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException(
                'Expected a Integer value, got: ' . gettype($value)
            );
        }
    }
}
