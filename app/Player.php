<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $with = ['terrain'];

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }
}
