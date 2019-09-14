<?php


namespace App\Enums;


class Enum
{

    public static function random()
    {
        $refl = new \ReflectionClass(static::class);
        $consts = array_flip($refl->getConstants());
        return random_int(0, count($consts) -1);
    }

    public static function all()
    {
        $refl = new \ReflectionClass(static::class);
        $consts = array_flip($refl->getConstants());
        return $consts;
    }

}