<?php
namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\PrimitiveValueObject;
use Mcustiel\TypedPhp\Types\Multiple\StringArray;
use Mcustiel\TypedPhp\ArrayValueObject;

class StringValue extends PrimitiveValueObject
{
    /**
     * @return integer
     */
    public function toInteger()
    {
        return (integer) $this->value();
    }

    /**
     * @return double
     */
    public function toDouble()
    {
        return (double) $this->value();
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function toDoubleValue()
    {
        return new DoubleValue((double) $this->value());
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function toIntegerValue()
    {
        return new IntegerValue((int) $this->value());
    }

    /**
     * {@inheritDoc}
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::validate()
     */
    protected function validate($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('Expected a string, got ' . gettype($value));
        }
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function reverse()
    {
        return new StringValue(strrev($this->value()));
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\StringValue $search
     * @param \Mcustiel\TypedPhp\Types\StringValue $replace
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function replace(StringValue $search, StringValue $replace)
    {
        return new StringValue(str_replace($search->value(), $replace->value(), $this->value()));
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\StringValue $glue
     * @param \Mcustiel\TypedPhp\ArrayValueObject $parts
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public static function implode(StringValue $glue, ArrayValueObject $parts)
    {
        return new StringValue(implode($glue->value(), $parts->value()));
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\StringValue $separator
     * @return \Mcustiel\TypedPhp\Types\Multiple\StringArray
     */
    public function explode(StringValue $separator)
    {
        return new StringArray(explode($separator->value(), $this->value()));
    }
}
