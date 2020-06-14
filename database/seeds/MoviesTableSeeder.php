<?php

use Illuminate\Database\Seeder;

use App\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 4; $i++) {
            Movie::create([
                'title' => $faker->word,
                'seo_title' => $faker->word,
                'certification' => $faker->randomElement(
                        ["U", "PG", "PG-13", "15", "18","X"]
                    ),
                'synopsis' => $faker->paragraph,
            ]);
        }
    }
}
