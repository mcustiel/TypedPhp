<?php
namespace Mcustiel\TypedPhp\ValueObjects\Multiple;

use Mcustiel\TypedPhp\Traits\Validation\PhpTypeChecker;
use Mcustiel\TypedPhp\ArrayValueObject;

class PrimitivesArray extends ArrayValueObject
{
    use PhpTypeChecker;

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\ArrayValueObject::checkArrayTypes()
     */
    protected function checkArrayTypes(array $array, $type)
    {
        if (!$this->isPhpType($type)) {
            throw new \InvalidArgumentException('Expected a php internal type, got ' . $type);
        }

        foreach ($array as $arrayItem) {
            if ($this->isOfInternalPhpType($arrayItem, $type)) {
                throw new \InvalidArgumentException(
                    'Expected an array of ' . $type . ', but one element is of type ' . gettype($arrayItem)
                );
            }
        }
    }
}
