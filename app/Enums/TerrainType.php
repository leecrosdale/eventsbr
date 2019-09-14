<?php


namespace App\Enums;


class TerrainType extends Enum
{

    const NORMAL = 0;
    const HIGH = 1;
    const LOW = 2;
    const WATER = 3;


    public static function randomLand()
    {
        $all = static::all();
        unset($all[0]);
        return random_int(0, count($all) -1);
    }


}