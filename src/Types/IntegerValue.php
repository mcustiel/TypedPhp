<?php

namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\PrimitiveValueObject;
use Mcustiel\TypedPhp\Traits\Conversion\ToBooleanConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToDoubleConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToStringConverter;

class IntegerValue extends PrimitiveValueObject
{
    use ToBooleanConverter, ToDoubleConverter, ToStringConverter;

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function add(IntegerValue $value)
    {
        return new self($this->value() + $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function substract(IntegerValue $value)
    {
        return new self($this->value() - $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function multiply(IntegerValue $value)
    {
        return new self($this->value() * $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function divide(IntegerValue $value)
    {
        return new self($this->value() / $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\IntegerValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function module(IntegerValue $value)
    {
        return new self($this->value() % $value->value());
    }

    /**
     * {@inheritdoc}
     *
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::validate()
     */
    protected function validate($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException('Expected an integer, got ' . gettype($value));
        }
    }
}
