<?php
namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Types\BooleanValue;

class BooleanCreator
{
    /**
     * @var BooleanValue[]
     */
    private static $values = [];

    /**
     * @param bool $value
     * @return BooleanValue
     */
    public static function getValueObject($value)
    {
        self::verifyType($value);
        return self::getValueFromCollection($value);
    }

    /**
     * @param boolean $value
     * @return BooleanValue
     */
    private static function getValueFromCollection($value)
    {
        $index = (string) $value;
        if (!isset(self::$values[$index])) {
            self::$values[$index] = new BooleanValue($value);
        }
        return self::$values[$index];
    }

    /**
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    private static function verifyType($value)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException(
                'Expected a boolean value, got: ' . gettype($value)
            );
        }
    }
}
