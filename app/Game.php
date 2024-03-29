<?php

namespace App;

use App\Enums\GameStatus;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

//    protected $with = ['players', 'items'];

//    protected $with = ['players'];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class)->withPivot(Player::$pivotStats);
    }

    public function game_players()
    {
        return $this->hasMany(GamePlayer::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot(['x', 'y']);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function unfinshed_actions()
    {
        return $this->hasMany(Action::class)->where('complete', false);
    }


    public function generateMap($x = null, $y = null)
    {

        $map = $this->map;
        if ($x === null && $y === null) {
            $terrains = $map->terrain;
            $players = $this->players;
            $items = $this->items;
        } else {

            $max_x = $x + 3;
            $max_y = $y + 3;

            $min_x = $x - 3;
            $min_y = $y - 3;

            $terrains = $map->terrain()
                ->where('x', '>=', $min_x)->where('x', '<=', $max_x)
                ->where('y', '>=', $min_y)->where('y', '<=', $max_y)->get();

            $players = $this->players()->where('x', '>=', $min_x)->where('x', '<=', $max_x)
                ->where('y', '>=', $min_y)->where('y', '<=', $max_y)->get();

            $items = $this->items()->where('x', '>=', $min_x)->where('x', '<=', $max_x)
                ->where('y', '>=', $min_y)->where('y', '<=', $max_y)->where('active', true)-> get();

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

    public function getStatusStringAttribute()
    {
        return GameStatus::STRINGS[$this->status];
    }

    public function addItems($items)
    {
        for ($i = 0; $i<$items; $i++) {

            $terrain = \App\Terrain::where('type','!=', \App\Enums\TerrainType::WATER)->get()->random(1)->first();
            $item = \App\Item::all()->random(1)->first();
            $this->items()->attach([['item_id' => $item->id, 'x' => $terrain->x, 'y' => $terrain->y]]);
            $terrain->save();

        }
    }

}
