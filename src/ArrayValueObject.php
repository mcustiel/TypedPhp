<?php
namespace Mcustiel\TypedPhp;

abstract class ArrayValueObject extends \ArrayObject implements Primitive
{
    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     * @param array $value
     */
    public function __construct($type, array $value)
    {
        $this->type = $type;
        $this->validate($value);
        parent::__construct($value);
    }

    /**
     * @param array $value
     */
    protected function validate(array $value)
    {
        $this->checkArrayTypes($value, $this->type);
    }

    /**
     * @return array
     */
    public function value()
    {
        return $this->getArrayCopy();
    }

    /**
     * @param array $array
     * @param string $type
     */
    protected function checkArrayTypes(array $array, $type)
    {
        return;
    }
}
