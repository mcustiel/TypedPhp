<?php
namespace Mcustiel\TypedPhp\Test\Types\Multiple;

use Mcustiel\TypedPhp\Types\Multiple\PrimitivesArray;
use Mcustiel\TypedPhp\Extra\PhpTypes;

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
     * @expectedException \InvalidArgumentException
     */
    public function shouldFailWhenGivingAnIncorrectType($type)
    {
        new PrimitivesArray($type, []);
    }

    /**
     * @test
     * @dataProvider validTypesProvider
     */
    public function shouldCreateWithCorrectArguments($type)
    {
        $array = new PrimitivesArray($type, []);
        $this->assertEquals([], $array->value());
    }
}
