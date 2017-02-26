<?php
namespace Mcustiel\TypedPhp\Traits\Conversion;

use Mcustiel\TypedPhp\Types\StringValue;

trait ToStringConverter
{
    /**
     * @return \Mcustiel\TypedPhp\Types\StringValue
     */
    public function toStringValue()
    {
        return new StringValue($this->__toString());
    }
}
