<?php
namespace Mcustiel\TypedPhp\Traits\Validation;

trait PhpTypeChecker
{
    const PHP_TYPES = [
        'boolean',
        'integer',
        'double',
        'string',
        'array',
        'object',
        'resource',
        'NULL',
    ];

    /**
     * @param string $type
     * @return boolean
     */
    private function isPhpType($type)
    {
        return in_array($type, self::PHP_TYPES);
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
