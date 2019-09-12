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
        $terrains = $this->terrain;

        $data = [];

        foreach ($terrains as $terrain) {
            $data[$terrain->y][$terrain->x] = $terrain;
        }

        return $data;

    }

}
