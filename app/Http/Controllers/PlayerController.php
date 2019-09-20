<?php

namespace App\Http\Controllers;

use App\Game;
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

    public function move(Game $game)
    {

        $player = Auth::user()->player;

        $game = $player->games()->where('game_id', $game->id)->first() ?: abort(404);




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
