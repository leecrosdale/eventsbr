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
        return $this->belongsToMany(Player::class)->withPivot(['x','y']);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot(['x','y']);
    }


    public function generateMap($x = null, $y = null, $max_x = 4, $max_y = 4)
    {

        $map = $this->map;

        if ($x === null && $y === null) {
            $terrains = $map->terrain;
        } else {
            $terrains = $map->terrain()
                ->where('x', '>=', $x)->where('x', '<=', $max_x)
                ->where('y', '>=', $y)->where('y', '<=', $max_y)->get();
        }

        $data = [];

        foreach ($terrains as $terrain) {
            $data[$terrain->y][$terrain->x]['terrain'] = $terrain;
        }

        foreach ($this->players as $player) {
            $data[$player->pivot->y][$player->pivot->x]['players'][] = $player;
        }

        foreach ($this->items as $item) {
            $data[$item->pivot->y][$item->pivot->x]['items'][] = $item;
        }


        return $data;

    }

}
