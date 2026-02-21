<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class countriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Countries::truncate();

        $json = File::get('database/data/country.json');
        $countries = json_decode($json);

        foreach ($countries as $key => $value) {
            Countries::create([
                'code' => $value->code,
                'name' => $value->name,
            ]);
        }
    }
}
