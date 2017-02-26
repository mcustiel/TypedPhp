<?php
namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\PrimitiveValueObject;
use Mcustiel\TypedPhp\Traits\Conversion\ToBooleanConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToIntegerConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToStringConverter;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;

class DoubleValue extends PrimitiveValueObject
{
    use ToBooleanConverter, ToIntegerConverter, ToStringConverter;

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::__toString()
     */
    public function __toString()
    {
        return number_format($this->value(), 3);
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
