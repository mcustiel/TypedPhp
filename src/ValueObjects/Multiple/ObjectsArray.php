<?php
namespace Mcustiel\TypedPhp\ValueObjects\Multiple;

use Mcustiel\TypedPhp\ArrayValueObject;

class ObjectsArray extends ArrayValueObject
{
    use InstanceOfChecker;

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\ArrayValueObject::checkArrayTypes()
     */
    protected function checkArrayTypes(array $array, $type)
    {
        if (!class_exists($type)) {
            throw new \Exception('Expected a class name, got ' . $type);
        }

        foreach ($array as $arrayItem) {
            $this->isInstanceOf($arrayItem, $type);
        }
    }
}
