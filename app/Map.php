<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public function terrain()
    {
        return $this->hasMany(Terrain::class);
    }

    public function generateMap($x = null, $y = null, $max_x = 4, $max_y = 4)
    {

        if ($x === null && $y === null) {
            $terrains = $this->terrain;
        } else {
            $terrains = $this->terrain()
                ->where('x', '>=', $x)->where('x', '<=', $max_x)
                ->where('y', '>=', $y)->where('y', '<=', $max_y)->get();
        }

        $data = [];


        foreach ($terrains as $terrain) {
            $data[$terrain->y][$terrain->x] = $terrain;
        }

        return $data;

    }

}
