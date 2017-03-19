<?php

namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Traits\Creation\Singleton;
use Mcustiel\TypedPhp\Types\StringValue;

class StringCreator extends FlyWeightPrimitiveCreator
{
    use Singleton;

    /**
     * @param string $value
     *
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function getValueObject($value)
    {
        $this->verifyType($value);

        return $this->getValueFromCollection($value);
    }

    /**
     * @param string $value
     *
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    protected function createValue($value)
    {
        return new StringValue($value);
    }

    /**
     * @param mixed $value
     *
     * @throws \InvalidArgumentException
     */
    private function verifyType($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException(
                'Expected a string value, got: '.gettype($value)
            );
        }
    }
}
