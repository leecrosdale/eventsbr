<?php


namespace App\Enums;


class GameStatus extends Enum
{

    const LOBBY = 0;
    const STARTING = 1;
    const RUNNING = 2;
    const ENDED = 3;

}