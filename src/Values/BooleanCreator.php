<?php

namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Traits\Creation\Singleton;
use Mcustiel\TypedPhp\Types\BooleanValue;

class BooleanCreator extends FlyWeightPrimitiveCreator
{
    use Singleton;

    /**
     * @param bool $value
     *
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    public function getValueObject($value)
    {
        $this->verifyType($value);

        return $this->getValueFromCollection($value);
    }

    /**
     * @param bool $value
     *
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    protected function createValue($value)
    {
        return new BooleanValue($value);
    }

    /**
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    private function verifyType($value)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException(
                'Expected a boolean value, got: ' . gettype($value)
            );
        }
    }
}
