<?php

use Illuminate\Database\Seeder;

use App\Showing;

class ShowingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Showing::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 4; $i++) {
            Showing::create([
                'movie_id' => rand(1,4),
                'start_at' => $faker->dateTime,
            ]);
        }
    }
}
