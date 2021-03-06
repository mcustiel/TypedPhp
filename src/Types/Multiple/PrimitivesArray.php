<?php

namespace Mcustiel\TypedPhp\Types\Multiple;

use Mcustiel\TypedPhp\ArrayValueObject;
use Mcustiel\TypedPhp\Traits\Validation\PhpTypeChecker;

class PrimitivesArray extends ArrayValueObject
{
    use PhpTypeChecker;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     * @param array  $array
     */
    public function __construct($type, array $array = [])
    {
        if (!$this->isPhpType($type)) {
            throw new \InvalidArgumentException('Expected a php internal type, got ' . $type);
        }
        $this->type = $type;
        parent::__construct($array);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Mcustiel\TypedPhp\ArrayValueObject::validate()
     */
    protected function validate($value)
    {
        if (!$this->isOfInternalPhpType($value, $this->type)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Trying to save an element of an invalid type in an array of %s',
                    $this->type
                )
            );
        }
    }
}
