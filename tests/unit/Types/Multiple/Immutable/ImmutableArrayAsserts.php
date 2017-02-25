<?php
namespace Mcustiel\TypedPhp\Test\Types\Multiple\Immutable;

abstract class ImmutableArrayAsserts extends \PHPUnit_Framework_TestCase
{
    public function assertAddingDataNotAllowed($className, array $data, $extra)
    {
        $this->expectException(\RuntimeException::class);
        $array = new $className($data);
        $array[] = $extra;
    }

    public function assertRemovingDataNotAllowed($className, array $data)
    {
        $this->expectException(\RuntimeException::class);
        $array = new $className($data);
        unset($array[0]);
    }
}
