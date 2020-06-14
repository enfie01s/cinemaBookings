<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'customer_id' => rand(1,4),
        'showing_id' => rand(1,4),
        'seats' => json_encode(
            array_rand(
                [
                    "A1"=>1, "A2"=>1, "A3"=>1, "A4"=>1, "A5"=>1,
                    "A6"=>1, "A7"=>1, "A8"=>1, "A9"=>1, "A10"=>1,
                ],rand(1,10)
            )
        )
    ];
});
