<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['game_id', 'player_id', 'turn', 'action', 'data'];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
