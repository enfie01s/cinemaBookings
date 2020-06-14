<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'seo_title' => $faker->word,
        'certification' => $faker->randomElement(
                ["U", "PG", "PG-13", "15", "18","X"]
            ),
        'synopsis' => $faker->paragraph,
    ];
});
