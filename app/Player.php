<?php

namespace App;

use App\Enums\ActionType;
use App\Enums\GameStatus;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $with = ['terrain'];

    public static $pivotStats = ['x', 'y', 'health', 'stamina', 'state'];

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class)->withPivot(static::$pivotStats);
    }

    public function activeGame()
    {
        return $this->belongsToMany(Game::class)->where('status', '!=', GameStatus::ENDED);
    }

    public function gamePlayer(Game $game)
    {
        return $this->hasMany(GamePlayer::class)->where('game_id', $game->id);
    }

    public function move(Game $game, $direction)
    {
        return Action::create([
            'game_id' => $game->id,
            'player_id' => $this->id,
            'turn' => $game->current_turn,
            'action' => ActionType::MOVE,
            'data' => $direction
        ]);
    }

    public function pickup(Game $game, $itemId)
    {
        return Action::create([
            'game_id' => $game->id,
            'player_id' => $this->id,
            'turn' => $game->current_turn,
            'action' => ActionType::PICKUP,
            'data' => $itemId
        ]);
    }

    public function doPickup(Game $game, $itemId)
    {
        $player = $this->gamePlayer($game)->first() ?: abort(404);
        $item = GameItem::where('game_id', $game->id)->where('item_id', $itemId)->where('x', $player->x)->where('y', $player->y)->where('active', true)->first();

        if ($item) {

            $item->active = false;
            $item->save();

            PlayerItem::create([
                'player_id' => $this->id,
                'game_id' => $game->id,
                'item_id' => $item->item_id
            ]);

        }
    }

    public function doMove(Game $game, $direction)
    {

        $player = $this->gamePlayer($game)->first() ?: abort(404);


        switch ($direction) {

            case 'N':
                --$player->y;
                break;
            case 'NE':
                --$player->y;
                ++$player->x;
                break;
            case 'E':
                ++$player->x;
                break;
            case 'SE':
                ++$player->y;
                ++$player->x;
                break;
            case 'S':
                ++$player->y;
                break;
            case 'SW':
                ++$player->y;
                --$player->x;
                break;
            case 'W':
                --$player->x;
                break;
            case 'NW':
                --$player->x;
                --$player->y;
                break;


        }

        $max_x = $game->map->max_x;
        $max_y = $game->map->max_y;

        if ($player->y < 0) {
            $player->y = 0;
        } elseif ($player->y > $max_y) {
            $player->y = $max_y;
        }

        if ($player->x < 0) {
            $player->x = 0;
        } elseif ($player->x > $max_x) {
            $player->x = $max_x;
        }

        $player->save();

    }

}
