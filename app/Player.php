<?php

namespace App;

use App\Enums\ActionType;
use App\Enums\GameStatus;
use App\Enums\ItemType;
use App\Events\Dead;
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

    public function shoot(Game $game, $direction)
    {
        return Action::create([
            'game_id' => $game->id,
            'player_id' => $this->id,
            'turn' => $game->current_turn,
            'action' => ActionType::SHOOT,
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

    public function doShoot(Game $game, $direction)
    {

        $player = $this->gamePlayer($game)->first() ?: abort(404);


        // Get Weapon
        $weapon = $player->weapon;
        $enemies = null;

        if ($weapon) {

            $distance = $weapon->distance;
            $damage = $weapon->stat;

            $x = $player->x;
            $y = $player->y;

            switch ($direction) {

                case 'N':
                    $y -= $distance;
                    $enemies = $game->game_players()->where('x', $x)->where('y', '<=', $y);
                    break;
//                case 'NE':
//                    --$player->y;
//                    ++$player->x;
//                    break;
                case 'E':
                    $x += $distance;
                    $enemies = $game->game_players()->where('x', '>=', $x)->where('y', $y);
                    break;
//                case 'SE':
//                    ++$player->y;
//                    ++$player->x;
//                    break;
                case 'S':
                    $y += $distance;
                    $enemies = $game->game_players()->where('x', $x)->where('y', '>=', $y);
                    break;
//                case 'SW':
//                    ++$player->y;
//                    --$player->x;
//                    break;
                case 'W':
                    $x -= $distance;
                    $enemies = $game->game_players()->where('x', '<=', $x)->where('y', $y);
                    break;
//                case 'NW':
//                    --$player->x;
//                    --$player->y;
//                    break;

            }

            if ($enemies && $enemies->exists()) {

                $enemies->get()->each(function (GamePlayer $enemy) use ($game, $damage) {

                    // Does enemy have armor
                    if ($enemy->armor) {
                        $healthLost = $damage / $enemy->armor->stat;
                    } else {
                        $healthLost = $damage;
                    }

                    $enemy->health -= $healthLost;
                    $enemy->save();

                    if ($enemy->health <= 0) {
                        event(new Dead($game, $enemy));
                    }

                });
            }

        }


    }

    public function doPickup(Game $game, $itemId)
    {
        $player = $this->gamePlayer($game)->first() ?: abort(404);
        $item = GameItem::where('game_id', $game->id)->where('item_id', $itemId)->where('x', $player->x)->where('y', $player->y)->where('active', true)->first();

        if ($player && $item) {

            $item->active = false;
            $item->save();

            PlayerItem::create([
                'player_id' => $this->id,
                'game_id' => $game->id,
                'item_id' => $item->item_id
            ]);

            switch ($item->item->type) {

                case ItemType::WEAPON:
                    $player->item_weapon_id = $item->item_id;
                    break;
                case ItemType::ARMOR:
                    $player->item_armor_id = $item->item_id;
                    break;

            }

            $player->save();

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
