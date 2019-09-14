<?php

use Illuminate\Database\Seeder;

class GamePlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $players = \App\Player::all();


        foreach ($players as $player) {

            $amount = random(1,3);

            $games = \App\Game::all()->random($amount)->get();


            foreach ($games as $game)
            {

                $game->players()->attach($player->id);

            }


        }


    }
}
