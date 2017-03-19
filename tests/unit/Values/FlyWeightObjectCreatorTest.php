<?php

namespace Mcustiel\TypedPhp\Test\Values;

use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableIntegerArray;
use Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableStringArray;
use Mcustiel\TypedPhp\Values\FlyWeightObjectCreator;

/**
 * @covers \Mcustiel\TypedPhp\Values\FlyWeightObjectCreator
 * @covers \Mcustiel\TypedPhp\Traits\Creation\SingletonMcustiel\TypedPhp\Test\Types\
 */
class FlyWeightObjectCreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnAValidObjectValue()
    {
        $value = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
        );
        $this->assertInstanceOf(ImmutableStringArray::class, $value);
        $this->assertSame(['potato'], $value->value());
    }

    /**
     * @test
     */
    public function shouldReturnTheSameObjectOnMultipleCalls()
    {
        $value1 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
        );
        $value2 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
        );
        $this->assertSame($value1, $value2);
    }

    /**
     * @before
     */
    public function clearValues()
    {
        FlyWeightObjectCreator::instance()->clear();
    }

    /**
     * @test
     */
    public function shouldClearAllValues()
    {
        $strings1 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
        );
        $integers1 = FlyWeightObjectCreator::instance()->getValueObject(
            [3],
            ImmutableIntegerArray::class
        );
        FlyWeightObjectCreator::instance()->clear();
        $strings2 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
        );
        $integers2 = FlyWeightObjectCreator::instance()->getValueObject(
            [3],
            ImmutableIntegerArray::class
        );
        $this->assertFalse($strings1 === $strings2);
        $this->assertFalse($integers1 === $integers2);
    }

    /**
     * @test
     */
    public function shouldClearOnlyValuesOfAnObject()
    {
        $strings1 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
            );
        $integers1 = FlyWeightObjectCreator::instance()->getValueObject(
            [3],
            ImmutableIntegerArray::class
            );
        FlyWeightObjectCreator::instance()->clear(ImmutableStringArray::class);
        $strings2 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
            );
        $integers2 = FlyWeightObjectCreator::instance()->getValueObject(
            [3],
            ImmutableIntegerArray::class
            );
        $this->assertFalse($strings1 === $strings2);
        $this->assertTrue($integers1 === $integers2);
    }

    /**
     * @test
     */
    public function shouldFailIfThereAreNoObjectsCOllectionInitialized()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('There are no objects registered for class Mcustiel\TypedPhp\Types\Multiple\Immutable\ImmutableStringArray');
        FlyWeightObjectCreator::instance()->getValueObject(
            [3],
            ImmutableIntegerArray::class
            );
        FlyWeightObjectCreator::instance()->clear(ImmutableStringArray::class);
    }

    /**
     * @test
     */
    public function shouldUnsetAValue()
    {
        $value1 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
        );
        FlyWeightObjectCreator::instance()->removeValue($value1);
        $value2 = FlyWeightObjectCreator::instance()->getValueObject(
            ['potato'],
            ImmutableStringArray::class
        );
        $this->assertFalse($value1 === $value2);
    }

    /**
     * @test
     */
    public function shouldFailIfTheValueIsNotSet()
    {
        $message = <<<'DOC'
The value Array
(
    [0] => potato
)
 is not stored
DOC;
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage($message);
        FlyWeightObjectCreator::instance()->removeValue(new ImmutableStringArray(['potato']));
    }
}
