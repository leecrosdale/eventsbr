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
                $data[] = [
                    'x' => $x,
                    'y' => $y,
                    'map_id' => $map->id,
                    'type' => \App\Enums\TerrainType::random()
                ];
            }
        }

        \App\Terrain::insert($data);

    }
}
