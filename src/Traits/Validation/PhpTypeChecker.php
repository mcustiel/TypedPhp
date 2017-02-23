<?php
namespace Mcustiel\TypedPhp\Traits\Validation;

use Mcustiel\TypedPhp\Extra\PhpTypes;

trait PhpTypeChecker
{
    /**
     * @param string $type
     * @return boolean
     */
    private function isPhpType($type)
    {
        return in_array($type, PhpTypes::PHP_TYPES);
    }

    /**
     * @param mixed $value
     * @param string $type
     * @return boolean
     */
    private function isOfInternalPhpType($value, $type)
    {
        return gettype($value) === $type;
    }
}
