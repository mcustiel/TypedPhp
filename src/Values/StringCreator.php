<?php
namespace Mcustiel\TypedPhp\Values;

use Mcustiel\TypedPhp\Types\StringValue;
use Mcustiel\TypedPhp\Traits\Creation\Singleton;

class StringCreator extends FlyWeightCreator
{
    use Singleton;

    /**
     * @param string $value
     * @return StringValue
     */
    public function getValueObject($value)
    {
        $this->verifyType($value);
        return $this->getValueFromCollection($value);
    }

    /**
     * @param string $value
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    protected function createValue($value)
    {
        return new StringValue($value);
    }

    /**
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    private function verifyType($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException(
                'Expected a string value, got: ' . gettype($value)
            );
        }
    }
}
