<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Game::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'password' => 'secret',
        'map_id' => \App\Map::all()->random(1)->first()->id
    ];
});
