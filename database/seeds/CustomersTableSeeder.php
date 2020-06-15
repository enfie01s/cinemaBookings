<?php

use Illuminate\Database\Seeder;

use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Add some customers to the database.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 4; $i++) {
            Customer::create([
                'name' => $faker->name,
                'email' => $faker->email,
            ]);
        }
    }
}
