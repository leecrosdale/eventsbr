<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamePlayer extends Model
{
    protected $table = 'game_player';

    protected $appends = ['weapon', 'armor'];


//    public function game()
//    {
//        return $this->belongsTo(Game::class);
//    }
//
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function getWeaponAttribute()
    {
        return Item::where('id', $this->item_weapon_id)->first();
    }

    public function getArmorAttribute()
    {
        return Item::where('id', $this->item_armor_id)->first();
    }



}
