<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'seo_title' => $faker->word,
        'certification' => $faker->randomElement(
                ["U", "PG", "PG-13", "15", "18","X"]
            ),
        'synopsis' => $faker->paragraph,
    ];
});
