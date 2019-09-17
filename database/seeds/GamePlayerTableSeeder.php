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

            $amount = random_int(1, 3);

            $games = \App\Game::all()->random($amount);

            foreach ($games as $game) {

                $terrain = $game->map->terrain()->where('type', '!=', \App\Enums\TerrainType::WATER)->get()->random(1)->first();

                $data = [
                    'player_id' => $player->id,
                    'x' => $terrain->x,
                    'y' => $terrain->y,
                    'state' => 0,
                    'health' => 100
                ];

                $game->players()->attach([$data]);
            }

        }

    }
}
