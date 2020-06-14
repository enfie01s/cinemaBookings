<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Showing;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Showing::class, function (Faker $faker) {
    return [
        'movie_id' => rand(1,4),
        'start_at' => $faker->dateTime,
    ];
});
