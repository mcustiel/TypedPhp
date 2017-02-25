<?php
namespace Mcustiel\TypedPhp\Types\Multiple;

use Mcustiel\TypedPhp\ArrayValueObject;
use Mcustiel\TypedPhp\Traits\Validation\InstanceOfChecker;
use Mcustiel\TypedPhp\Traits\Validation\PhpTypeChecker;

class ObjectsArray extends ArrayValueObject
{
    use InstanceOfChecker, PhpTypeChecker;

    /**
     * @var string
     */
    private $className;

    /**
     * @param string $className
     * @param array $array
     */
    public function __construct($className, array $array = [])
    {
        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Expected a class name, got ' . $className);
        }
        $this->className = $className;
        parent::__construct($array);
    }

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\ArrayValueObject::checkArrayTypes()
     */
    protected function validate($value)
    {
        if (!$this->isInstanceOf($value, $this->className)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Trying to save an element of an invalid type in an array of %s ',
                    $this->className
                )
            );
        }
    }
}
