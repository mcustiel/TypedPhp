<?php

namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Traits\Creation\Singleton;
use Mcustiel\TypedPhp\Types\IntegerValue;

class IntegerCreator extends FlyWeightPrimitiveCreator
{
    use Singleton;

    /**
     * @param int $value
     *
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function getValueObject($value)
    {
        $this->verifyType($value);

        return $this->getValueFromCollection($value);
    }

    /**
     * @param int $value
     *
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    protected function createValue($value)
    {
        return new IntegerValue($value);
    }

    /**
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    private function verifyType($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException(
                'Expected a integer value, got: '.gettype($value)
            );
        }
    }
}
