<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


//TODO
Broadcast::channel('game.{gameId}', function ($user, $gameId) {
    return true;
    //return $user->id === Order::findOrNew($orderId)->user_id;
    $player = $user->player;
    $game = $player->games()->where('game_id', $gameId)->first();
    if (!$game) {
        return false;
    }
    return (bool) $game->players()->where('player_id', $player->id)->first(); // TODO Add logic to check if user is actually in the game.
});

Broadcast::channel('game.{gameId}.{playerId}', function ($user, $gameId) {
    return true;
});