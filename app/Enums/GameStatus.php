<?php


namespace App\Enums;


class GameStatus extends Enum
{

    const LOBBY = 0;
    const RUNNING = 1;
    const ENDED = 2;

    const STRINGS = [
        self::LOBBY => 'lobby',
        self::RUNNING => 'running',
        self::ENDED => 'ended',
    ];


}