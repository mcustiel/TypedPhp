<?php
namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\PrimitiveValueObject;

class IntegerValue extends PrimitiveValueObject
{
    /**
     * @return double
     */
    public function toDouble()
    {
        return (double) $this->value();
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function toStringValue()
    {
        return new StringValue((string) $this->value());
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function toDoubleValue()
    {
        return new DoubleValue((double) $this->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function add(IntegerValue $value)
    {
        return new IntegerValue($this->value() + $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function substract(IntegerValue $value)
    {
        return new IntegerValue($this->value() - $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function multiply(IntegerValue $value)
    {
        return new IntegerValue($this->value() * $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function divide(IntegerValue $value)
    {
        return new IntegerValue($this->value() / $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function module(IntegerValue $value)
    {
        return new IntegerValue($this->value() % $value->value());
    }

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::validate()
     */
    protected function validate($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException('Expected an integer, got ' . gettype($value));
        }
    }
}
