<?php

namespace App\Listeners;

use App\Enums\ActionType;
use App\Events\GameTick;
use App\Events\NextTurn;
use App\Game;
use App\Player;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExecuteGameTick
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param GameTick $event
     * @return void
     */
    public function handle(GameTick $event)
    {
        $game = $event->game;

        // Execute the game
        $actions = $game->unfinshed_actions()->get();

        foreach ($actions as $action) {

            switch ($action->action) {
                case ActionType::MOVE:

                    $player = $action->player;
                    $player->doMove($action->game, $action->data);

                    break;

            }


            $action->complete = true;
            $action->save();

        }

        ++$game->current_turn;
        $game->save();

        event(new NextTurn($game));
    }

}

