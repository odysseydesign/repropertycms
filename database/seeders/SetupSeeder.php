<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            countriesSeeder::class,
            StatesSeeder::class,
            amenitiesSeeder::class,
            PlansSeeder::class,
        ]);
    }
}
