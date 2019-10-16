<?php

namespace App\Console\Commands;

use App\Enums\GameStatus;
use App\Events\GameTick;
use App\Game;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ForceTurn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'turns:force';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forces the turns of all games that have been running longer than 30 seconds';

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

        $count = 0;

        do {

            $games = Game::where('status', GameStatus::RUNNING)->where('updated_at', '<=', Carbon::now()->addSeconds(-0.5)->toDateTimeString())->get();

            foreach ($games as $game)
            {
                $this->comment("Forcing tick of {$game->id}");
                if ($game->unfinshed_actions()->count > 0) {
                    // Only fire event if there are actions to run..
                    event(new GameTick($game));
                }

            }

//            sleep(31);
            sleep(15);

            $count++;

        }while($count < 4);


    }
}
