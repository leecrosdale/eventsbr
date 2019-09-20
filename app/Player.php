<?php

namespace App;

use App\Enums\GameStatus;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $with = ['terrain'];

    public static $pivotStats = ['x','y','health','stamina','state'];

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



}
