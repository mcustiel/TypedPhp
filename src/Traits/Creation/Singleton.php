<?php

namespace Mcustiel\TypedPhp\Traits\Creation;

trait Singleton
{
    /**
     * @var static
     */
    private static $instance;

    /**
     * @return static
     */
    public static function instance()
    {
        if (self::$instance === null) {
            $class = __CLASS__;
            self::$instance = new $class();
        }

        return self::$instance;
    }
}
