<?php

namespace App\Http\Controllers;

use App\Events\GameTick;
use App\Game;
use App\GamePlayer;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{

    public function play(Game $game)
    {
        $player = Auth::user()->player;
        return view('player.play')->withPlayer($player)->withGameId($game->id);
    }

    public function pickup(Request $request, Game $game)
    {
        $player = $this->getPlayer($game);

        $action = $player->pickup($game, $request->item_id);

        $pivot = $player->gamePlayer($game)->first();
        $pivot->stamina -= config('game.pickup.stamina_cost');
        $pivot->save();

        return ['status' => 'success', 'action' => $action];
    }

    public function move(Request $request, Game $game)
    {
        $player = $this->getPlayer($game);
        $action = $player->move($game, $request->direction);

        $pivot = $player->gamePlayer($game)->first();
        $pivot->stamina -= config('game.move.stamina_cost');
        $pivot->save();

        return ['status' => 'success', 'action' => $action];
    }

    public function shoot(Request $request, Game $game)
    {
        $player = $this->getPlayer($game);
        $action = $player->shoot($game, $request->direction);

        $pivot = $player->gamePlayer($game)->first();
        $pivot->stamina -= config('game.shoot.stamina_cost');
        $pivot->save();

        return ['status' => 'success', 'action' => $action];

    }

    public function getPlayer(Game $game)
    {
        $player = Auth::user()->player;

        $game = $player->games()->where('game_id', $game->id)->first() ?: abort(404);

        return $game->players()->where('player_id', $player->id)->first();
    }

    public function getGamePlayer(Game $game)
    {
        $player = Auth::user()->player;

        $game = $player->games()->where('game_id', $game->id)->first() ?: abort(404);

        return GamePlayer::where('game_id', $game->id)->where('player_id', $player->id)->with('player')->first();
    }

    public function getUpdate(Game $game)
    {
        $player = Auth::user()->player;

        $game = $player->games()->where('game_id', $game->id)->first() ?: abort(404);

        $gameData = $game->pivot;

        return $game->generateMap($gameData->x, $gameData->y);
    }

    public function action(Request $request)
    {
        // Move or Shoot or Pickup Item
    }

    public function status()
    {
        // you have {x] health
    }

    public function log()
    {
        // You got shot by {x}
    }

}
