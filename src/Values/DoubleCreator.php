<?php

namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Traits\Creation\Singleton;
use Mcustiel\TypedPhp\Types\DoubleValue;

class DoubleCreator extends FlyWeightPrimitiveCreator
{
    use Singleton;

    /**
     * @param float $value
     *
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function getValueObject($value)
    {
        $this->verifyType($value);

        return $this->getValueFromCollection($value);
    }

    /**
     * @param float $value
     *
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    protected function createValue($value)
    {
        return new DoubleValue($value);
    }

    /**
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    private function verifyType($value)
    {
        if (!is_float($value)) {
            throw new \InvalidArgumentException(
                'Expected a double value, got: ' . gettype($value)
            );
        }
    }
}
