<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class amenitiesSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('amenities')->where('agent_id', 0)->count() > 0) {
            return;
        }

        $now = now();

        $amenities = [
            'Beach Access',
            'City Lights Views',
            'Community Clubhouse',
            'Community Pool',
            'Frameless Glass Showers',
            'Gated Community',
            'Golf Course Lot',
            'Great Schools',
            'Hardwood Floors',
            'Heated Floors',
            'Heated Pool',
            'High Ceilings',
            'Large Kitchen',
            'Large Lot',
            'Mountain Views',
            'New Construction',
            'Ocean Views',
            'Open Floor Plan',
            'Oversized Windows',
            'Pool',
            'Quartz Countertops',
            'Quiet and Private',
            'Shopping Nearby',
            'Side-by-Side Washer and Dryer',
            'Spa',
            'Stainless Steel Appliances',
            'Walk-In Closets',
        ];

        $rows = array_map(fn($name) => [
            'name'       => $name,
            'agent_id'   => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ], $amenities);

        DB::table('amenities')->insert($rows);
    }
}
