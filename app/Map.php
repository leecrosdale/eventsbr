<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public function terrain()
    {
        return $this->hasMany(Terrain::class);
    }


    public function generateMap()
    {
        $map = $this;

        $data = [];

        for ($y = 0; $y<$map->max_y; $y++)
        {

            for ($x = 0; $x<$map->max_x; $x++) {

                $type = (($y === 0 || $map->max_y - 1 === $y)
                    || ($x === 0 || $map->max_x-1 === $x))
                    ? \App\Enums\TerrainType::WATER
                    : \App\Enums\TerrainType::randomLand();

                $data[] = [
                    'x' => $x,
                    'y' => $y,
                    'map_id' => $map->id,
                    'type' => $type,
                ];
            }
        }


        return \App\Terrain::insert($data);
    }

}
