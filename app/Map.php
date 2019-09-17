<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public function terrain()
    {
        return $this->hasMany(Terrain::class);
    }

}
