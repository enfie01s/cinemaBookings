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
        Schema::disableForeignKeyConstraints();
        $this->call(BookingsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(ShowingsTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
