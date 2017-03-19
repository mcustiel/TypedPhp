<?php

namespace Mcustiel\TypedPhp\Types;

use Mcustiel\TypedPhp\ArrayValueObject;
use Mcustiel\TypedPhp\PrimitiveValueObject;
use Mcustiel\TypedPhp\Traits\Conversion\ToBooleanConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToDoubleConverter;
use Mcustiel\TypedPhp\Traits\Conversion\ToIntegerConverter;
use Mcustiel\TypedPhp\Types\Multiple\StringArray;

class StringValue extends PrimitiveValueObject
{
    use ToBooleanConverter, ToDoubleConverter, ToIntegerConverter;

    /**
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function reverse()
    {
        return new self(strrev($this->value()));
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\StringValue $search
     * @param \Mcustiel\TypedPhp\Types\StringValue $replace
     *
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function replace(StringValue $search, StringValue $replace)
    {
        return new self(str_replace($search->value(), $replace->value(), $this->value()));
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\StringValue $glue
     * @param \Mcustiel\TypedPhp\ArrayValueObject  $parts
     *
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public static function implode(StringValue $glue, ArrayValueObject $parts)
    {
        return new self(implode($glue->value(), $parts->value()));
    }

    /**
     * @param \Mcustiel\TypedPhp\Types\StringValue $separator
     *
     * @return \Mcustiel\TypedPhp\Types\Multiple\StringArray
     */
    public function explode(StringValue $separator)
    {
        return new StringArray(explode($separator->value(), $this->value()));
    }

    /**
     * {@inheritdoc}
     *
     * @see \Mcustiel\TypedPhp\PrimitiveValueObject::validate()
     */
    protected function validate($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('Expected a string, got ' . gettype($value));
        }
    }
}
