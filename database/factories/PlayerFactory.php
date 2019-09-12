<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Player::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'terrain_id' => \App\Terrain::all()->random(1)->first()->id,
        'state' => 0
    ];
});
