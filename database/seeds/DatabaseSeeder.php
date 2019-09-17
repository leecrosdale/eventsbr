<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(MapsTableSeeder::class);
         $this->call(GamesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ItemsTableSeeder::class);
         $this->call(GamePlayerTableSeeder::class);
        //$this->call(ItemsTableSeeder::class);

    }
}
