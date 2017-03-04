<?php
namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Primitive;

abstract class FlyWeightCreator
{
    /**
     * @var \Mcustiel\TypedPhp\Primitive[]
     */
    private $values;

    protected function __construct()
    {
        $this->clear();
    }

    /**
     * @param Primitive $value
     * @throws \Mcustiel\TypedPhp\\RuntimeException
     */
    public function removeValue(Primitive $value)
    {
        $index = (string) $value->value();
        if (!isset($this->values[$index])) {
            throw new \RuntimeException(sprintf('The value %s is not stored', $index));
        }
        unset($this->values[$index]);
    }

    public function clear()
    {
        $this->values = [];
    }

    /**
     * @param mixed $value
     * @return \Mcustiel\TypedPhp\Primitive
     */
    abstract public function getValueObject($value);

    /**
     * @param mixed $value
     * @return \Mcustiel\TypedPhp\Primitive
     */
    abstract protected function createValue($value);

    /**
     * @param mixed $value
     * @return \Mcustiel\TypedPhp\Types\Primitive
     */
    protected function getValueFromCollection($value)
    {
        $index = (string) $value;
        if (!isset($this->values[$index])) {
            $this->values[$index] = $this->createValue($value);
        }
        return $this->values[$index];
    }
}
