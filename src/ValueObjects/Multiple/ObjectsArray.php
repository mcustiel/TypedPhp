<?php
namespace Mcustiel\TypedPhp\ValueObjects\Multiple;

use Mcustiel\TypedPhp\ArrayValueObject;
use Mcustiel\TypedPhp\Traits\Validation\InstanceOfChecker;

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
            if (!$this->isInstanceOf($arrayItem, $type)) {
                throw new \InvalidArgumentException(
                    'Expected an array of ' . $type . ', but one element is of type ' . get_class($arrayItem)
                );
            }
        }
    }
}
