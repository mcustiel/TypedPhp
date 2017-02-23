<?php
namespace Mcustiel\TypedPhp\Traits\Validation;

trait InstanceOfChecker
{
    /**
     * @param object $value
     * @param string $className
     * @return boolean
     */
    private function isInstanceOf($value, $className)
    {
        return $value instanceof $className;
    }
}
