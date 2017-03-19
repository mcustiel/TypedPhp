<?php

namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Primitive;
use Mcustiel\TypedPhp\Traits\Creation\Singleton;

class FlyWeightObjectCreator
{
    use Singleton;

    /**
     * @var \Mcustiel\TypedPhp\Primitive[][]
     */
    private $values;

    protected function __construct()
    {
        $this->clear();
    }

    /**
     * @param \Mcustiel\TypedPhp\Primitive $value
     *
     * @throws \RuntimeException
     */
    public function removeValue(Primitive $value)
    {
        $index = serialize($value->value());
        $class = get_class($value);
        if (!isset($this->values[$class][$index])) {
            throw new \RuntimeException(sprintf('The value %s is not stored', $value));
        }
        unset($this->values[$class][$index]);
    }

    /**
     * @param string $class
     *
     * @throws \InvalidArgumentException
     */
    public function clear($class = null)
    {
        if ($class === null) {
            $this->values = [];
        } elseif (isset($this->values[$class])) {
            $this->values[$class] = [];
        } else {
            throw new \InvalidArgumentException(
                sprintf('There are no objects registered for class %s', $class)
            );
        }
    }

    /**
     * @param mixed $value
     * @param mixed $class
     *
     * @return \Mcustiel\TypedPhp\Primitive
     */
    public function getValueObject($value, $class)
    {
        $index = serialize($value);
        if (!isset($this->values[$class][$index])) {
            $this->initCollectionForClass($class);
            $this->values[$class][$index] = new $class($value);
        }

        return $this->values[$class][$index];
    }

    /**
     * @param string class
     * @param mixed $class
     */
    private function initCollectionForClass($class)
    {
        if (!isset($this->values[$class])) {
            $this->values[$class] = [];
        }
    }
}
