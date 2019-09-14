<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $weapons = ['pistol', 'walther-ppk', 'p90', 'ar15', 'm249', 're45', 'sa80', 'ump', 'diamond-pickaxe','m24', 'xm109'];
        $armours = ['lvl1', 'lvl2', 'lvl3'];

        foreach ($weapons as $k => $weapon) {
            \App\Item::create([
                'name' => $weapon,
                'type' => \App\Enums\ItemType::WEAPON
            ]);
        }

        foreach ($armours as $k => $armour) {
            \App\Item::create([
                'name' => $armour,
                'type' => \App\Enums\ItemType::ARMOUR
            ]);
        }


        $games = \App\Game::all();


        foreach ($games as $game) {


            $items = 10;

            for ($i = 0; $i<$items; $i++) {

                $terrain = \App\Terrain::where('type','!=', \App\Enums\TerrainType::WATER)->get()->random(1)->first();

                $item = \App\Item::all()->random(1)->first();

                $terrain->items()->attach(['item_id' => $item->id, 'game_id' => $game->id]);

                $terrain->save();

            }
        }

        // Make item generation work for multi game.

    }
}
