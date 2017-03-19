<?php

namespace Mcustiel\TypedPhp\Test\Traits\Conversion;

use Mcustiel\TypedPhp\Traits\Validation\PhpTypeChecker;

/**
 * @covers \Mcustiel\TypedPhp\Traits\Validation\PhpTypeChecker
 */
class PhpTypeCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function typesProvider()
    {
        return [
            'integer' => [2, gettype(2)],
            'double' => [2.1, gettype(2.1)],
            'string' => ['', gettype('')],
            'function' => [function () {
            }, gettype(function () {
            })],
            'object' => [new \stdClass(), gettype(new \stdClass())],
            'array' => [[], gettype([])],
            'boolean' => [true, gettype(true)],
            'null' => [null, gettype(null)],
        ];
    }

    /**
     * @test
     * @dataProvider typesProvider
     *
     * @param mixed $value
     * @param mixed $type
     */
    public function shouldReturnTrueIfIsPhpType($value, $type)
    {
        $this->assertTrue(
            (new PhpTypeValidator())->isPhpType($type)
        );
    }

    /**
     * @test
     */
    public function shouldReturnFalseIfIsNotPhpType()
    {
        $this->assertFalse(
            (new PhpTypeValidator())->isPhpType('potato')
        );
    }

    /**
     * @test
     * @dataProvider typesProvider
     *
     * @param mixed $value
     * @param mixed $type
     */
    public function shouldReturnTrueIfValueIsOfPhpType($value, $type)
    {
        $this->assertTrue(
            (new PhpTypeValidator())->isOfInternalPhpType($value, $type)
        );
    }

    /**
     * @test
     */
    public function shouldReturnFalseIfValueIsOfPhpType()
    {
        $this->assertFalse(
            (new PhpTypeValidator())->isOfInternalPhpType('', 'integer')
        );
    }
}

class PhpTypeValidator
{
    use PhpTypeChecker {
        isPhpType as public;
        isOfInternalPhpType as public;
    }
}
