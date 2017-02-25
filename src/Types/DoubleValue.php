<?php
namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\PrimitiveValueObject;

class DoubleValue extends PrimitiveValueObject
{
    /**
     * @return int
     */
    public function toInteger()
    {
        return (int) $this->value();
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function toStringValue()
    {
        return new StringValue((string) $this->value());
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function toIntegerValue()
    {
        return new IntegerValue((int) $this->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function add(DoubleValue $value)
    {
        return new DoubleValue($this->value() + $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function substract(DoubleValue $value)
    {
        return new DoubleValue($this->value() - $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function multiply(DoubleValue $value)
    {
        return new DoubleValue($this->value() * $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function divide(DoubleValue $value)
    {
        return new DoubleValue($this->value() / $value->value());
    }

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::validate()
     */
    protected function validate($value)
    {
        if (!is_double($value)) {
            throw new \InvalidArgumentException('Expected a double, got ' . gettype($value));
        }
    }
}
