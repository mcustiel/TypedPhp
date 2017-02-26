<?php
namespace Mcustiel\TypedPhp\Traits\Conversion;

use Mcustiel\TypedPhp\Types\DoubleValue;

trait ToDoubleConverter
{
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
     * @mixed
     */
    abstract public function value();
}
