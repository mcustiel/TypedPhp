<?php

namespace Mcustiel\TypedPhp\Traits\Conversion;

use Mcustiel\TypedPhp\Types\DoubleValue;

trait ToDoubleConverter
{
    /**
     * @return float
     */
    public function toDouble()
    {
        return (float) $this->value();
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\DoubleValue
     */
    public function toDoubleValue()
    {
        return new DoubleValue((float) $this->value());
    }

    /**
     * @mixed
     */
    abstract public function value();
}
