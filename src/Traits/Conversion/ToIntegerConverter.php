<?php
namespace Mcustiel\TypedPhp\Traits\Conversion;

use Mcustiel\TypedPhp\Types\IntegerValue;

trait ToIntegerConverter
{
    /**
     * @return int
     */
    public function toInteger()
    {
        return (int) $this->value();
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\IntegerValue
     */
    public function toIntegerValue()
    {
        return new IntegerValue((int) $this->value());
    }
}
