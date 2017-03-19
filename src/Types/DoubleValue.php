<?php

namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\PrimitiveValueObject;
use Mcustiel\TypedPhp\Traits\Conversion\ToBooleanConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToIntegerConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToStringConverter;

class DoubleValue extends PrimitiveValueObject
{
    use ToBooleanConverter, ToIntegerConverter, ToStringConverter;

    /**
     * {@inheritdoc}
     *
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::__toString()
     */
    public function __toString()
    {
        return number_format($this->value(), 3);
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function add(DoubleValue $value)
    {
        return new self($this->value() + $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function substract(DoubleValue $value)
    {
        return new self($this->value() - $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function multiply(DoubleValue $value)
    {
        return new self($this->value() * $value->value());
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\DoubleValue $value
     *
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function divide(DoubleValue $value)
    {
        return new self($this->value() / $value->value());
    }

    /**
     * {@inheritdoc}
     *
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::validate()
     */
    protected function validate($value)
    {
        if (!is_float($value)) {
            throw new \InvalidArgumentException('Expected a double, got '.gettype($value));
        }
    }
}
