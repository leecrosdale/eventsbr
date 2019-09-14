<?php

use Illuminate\Database\Seeder;

class MapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $map = factory(\App\Map::class)->create();

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


        \App\Terrain::insert($data);

    }
}
