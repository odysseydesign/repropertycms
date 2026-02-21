<?php

namespace Database\Seeders;

use App\Models\States;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        States::truncate();

        $json = File::get('database/data/state.json');
        $states = json_decode($json);

        foreach ($states as $key => $value) {
            States::create([
                'code' => $value->code,
                'name' => $value->name,
            ]);
        }
    }
}
