<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Map::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'max_x' => 60,// random_int(5,5),
        'max_y' => 30, //random_int(5,5),

    ];
});
