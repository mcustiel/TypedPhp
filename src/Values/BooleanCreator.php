<?php
namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Types\BooleanValue;
use Mcustiel\TypedPhp\Traits\Creation\Singleton;

class BooleanCreator extends FlyWeightCreator
{
    use Singleton;

    /**
     * @param bool $value
     * @return BooleanValue
     */
    public function getValueObject($value)
    {
        $this->verifyType($value);
        return $this->getValueFromCollection($value);
    }

    /**
     * @param bool $value
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    protected function createValue($value)
    {
        return new BooleanValue($value);
    }

    /**
     * @param mixed $value
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
