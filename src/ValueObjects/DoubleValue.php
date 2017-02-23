<?php
namespace Mcustiel\TypedPhp\ValueObjects;

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
     * @return \Mcustiel\TypedPhp\StringValue
     */
    public function toStringValue()
    {
        return new StringValue((string) $this->value());
    }

    /**
     * @return \Mcustiel\TypedPhp\IntegerValue
     */
    public function toIntegerValue()
    {
        return new IntegerValue((int) $this->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\DoubleValue $value
     * @return \Mcustiel\TypedPhp\DoubleValue
     */
    public function add(DoubleValue $value)
    {
        return new DoubleValue($this->value() + $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\DoubleValue $value
     * @return \Mcustiel\TypedPhp\DoubleValue
     */
    public function substract(DoubleValue $value)
    {
        return new DoubleValue($this->value() - $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\DoubleValue $value
     * @return \Mcustiel\TypedPhp\DoubleValue
     */
    public function multiply(DoubleValue $value)
    {
        return new DoubleValue($this->value() * $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\DoubleValue $value
     * @return \Mcustiel\TypedPhp\DoubleValue
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
