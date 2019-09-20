<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $with = ['players', 'items'];


    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class)->withPivot(Player::$pivotStats);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot(['x','y']);
    }


    public function generateMap($x = null, $y = null)
    {

        $map = $this->map;
        if ($x === null && $y === null) {
            $terrains = $map->terrain;
            $players = $this->players;
            $items = $this->items;
        } else {

            $max_x = $x + 4;
            $max_y = $y + 4;

            $terrains = $map->terrain()
                ->where('x', '>=', $x)->where('x', '<=', $max_x)
                ->where('y', '>=', $y)->where('y', '<=', $max_y)->get();

            $players = $this->players()->where('x', '>=', $x)->where('x', '<=', $max_x)
                ->where('y', '>=', $y)->where('y', '<=', $max_y)->get();
            $items = $this->items()->where('x', '>=', $x)->where('x', '<=', $max_x)
                ->where('y', '>=', $y)->where('y', '<=', $max_y)->get();;

        }


        $data = [];

        foreach ($terrains as $terrain) {
            $data[$terrain->y][$terrain->x]['terrain'] = $terrain;
        }
//
        foreach ($players as $player) {
            $data[$player->pivot->y][$player->pivot->x]['players'][] = $player;
        }

        foreach ($items as $item) {
            $data[$item->pivot->y][$item->pivot->x]['items'][] = $item;
        }




        return $data;

    }

}
