<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $with = ['players', 'items'];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
