<?php

namespace Database\Seeders;

use App\Models\Amenities;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class amenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Amenities::truncate();

        $json = File::get('database/data/amenitie.json');
        $amenities = json_decode($json);

        foreach ($amenities as $key => $value) {
            Amenities::create([
                'name' => $value->name,
            ]);
        }
    }
}
