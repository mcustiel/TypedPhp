<?php
namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Types\DoubleValue;
use Mcustiel\TypedPhp\Traits\Creation\Singleton;

class DoubleCreator extends FlyWeightCreator
{
    use Singleton;

    /**
     * @param double $value
     * @return DoubleValue
     */
    public function getValueObject($value)
    {
        $this->verifyType($value);
        return $this->getValueFromCollection($value);
    }

    /**
     * @param double $value
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    protected function createValue($value)
    {
        return new DoubleValue($value);
    }

    /**
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    private function verifyType($value)
    {
        if (!is_double($value)) {
            throw new \InvalidArgumentException(
                'Expected a double value, got: ' . gettype($value)
            );
        }
    }
}
