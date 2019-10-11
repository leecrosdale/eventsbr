<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameItem extends Model
{
    protected $table = 'game_item';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
