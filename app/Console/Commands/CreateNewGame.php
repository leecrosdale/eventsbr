<?php

namespace App\Console\Commands;

use App\Game;
use App\Map;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateNewGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:create {name} {max-players}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new game';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $game = Game::create([
            'map_id' => Map::all()->random(1)->first()->id,
            'name' => $this->argument('name'),
            'password' => Str::random(5),
            'max_players' => (int) $this->argument('max-players')
        ]);


        $game->addItems(100);



        $this->comment("Created game {$game->name}");
    }
}
