<?php
namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\PrimitiveValueObject;
use phpDocumentor\Reflection\Types\Boolean;
use Mcustiel\TypedPhp\Traits\Conversion\ToIntegerConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToDoubleConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToStringConverter;

class BooleanValue extends PrimitiveValueObject
{
    use ToIntegerConverter, ToDoubleConverter, ToStringConverter;

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::__toString()
     */
    public function __toString()
    {
        return $this->value() ? 'true' : 'false';
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\BooleanValue $value
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    public function and(BooleanValue $value)
    {
        return new BooleanValue($this->value() && $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\BooleanValue $value
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    public function or(BooleanValue $value)
    {
        return new BooleanValue($this->value() || $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\BooleanValue $value
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    public function xor(BooleanValue $value)
    {
        return new BooleanValue($this->value() xor $value->value());
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    public function not()
    {
        return new BooleanValue(!$this->value());
    }

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::validate()
     */
    protected function validate($value)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('Expected a boolean, got ' . gettype($value));
        }
    }
}
