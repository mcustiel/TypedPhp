<?php

namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Extra\PhpTypes;
use Mcustiel\TypedPhp\Types\Multiple\PrimitivesArray;

/**
 * @covers \Mcustiel\TypedPhp\Types\Multiple\PrimitivesArray
 * @covers \Mcustiel\TypedPhp\ArrayValueObject
 */
class PrimitivesArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function invalidTypesProvider()
    {
        return [
            ['potato'],
            [''],
            [1],
            [null],
            [5.5],
        ];
    }

    /**
     * @return array
     */
    public function validTypesProvider()
    {
        $types = [];
        foreach (PhpTypes::PHP_TYPES as $type) {
            $types[] = [$type];
        }

        return $types;
    }

    /**
     * @test
     * @dataProvider invalidTypesProvider
     *
     * @param mixed $type
     */
    public function shouldFailWhenGivingAnIncorrectType($type)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Expected a php internal type, got ' . $type
        );
        new PrimitivesArray($type, []);
    }

    /**
     * @test
     * @dataProvider validTypesProvider
     *
     * @param mixed $type
     */
    public function shouldCreateWithCorrectArguments($type)
    {
        $array = new PrimitivesArray($type, []);
        $this->assertSame([], $array->value());
    }
}
