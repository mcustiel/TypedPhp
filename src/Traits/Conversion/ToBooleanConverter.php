<?php

namespace Mcustiel\TypedPhp\Traits\Conversion;

use Mcustiel\TypedPhp\Types\BooleanValue;

trait ToBooleanConverter
{
    /**
     * @return bool
     */
    public function toBoolean()
    {
        return (bool) $this->value();
    }

    /**
     * @return \Mcustiel\TypedPhp\Types\BooleanValue
     */
    public function toBooleanValue()
    {
        return new BooleanValue((bool) $this->value());
    }

    /**
     * @mixed
     */
    abstract public function value();
}
