<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddPilotPlanToPlansTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    if (!DB::table('plans')->where('name', 'Pilot')->exists()) {
        DB::table('plans')->insert([
            'name' => 'Pilot',
            'price' => 29,
            'stripe_plan_id' => 'price_1RqKo779GGvBrptVxqwQPQGR',
            'interval' => 'month',
            'credits' => 1,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'description' => 'Pilot Program - Two month duration (50%) discount to the first 25 brokers, converts to regular pricing or you cancel your subscription anytime.',
        ]);
    }

    if (app()->environment('production')) {
        if (DB::table('plans')->where('name', 'Starter')->exists()) {
            DB::table('plans')->where('name', 'Starter')->update([
                'description' => '1 Property - Month to month recurring subscription. Cancel at anytime. Billed monthly',
                'stripe_plan_id' => 'price_1RqbPG79GGvBrptV31skNESJ',
            ]);
        }

        if (DB::table('plans')->where('name', 'Enhanced')->exists()) {
            DB::table('plans')->where('name', 'Enhanced')->update([
                'description' => 'Up to 5 Properties - Month to month recurring subscription. Cancel at anytime.',
                'stripe_plan_id' => 'price_1RqcYS79GGvBrptVwVwmGwW4',
            ]);
        }

        if (DB::table('plans')->where('name', 'Enterprise')->exists()) {
            DB::table('plans')->where('name', 'Enterprise')->update([
                'description' => 'Up to 30 Properties - Month to month recurring subscription. Cancel at anytime.',
                'stripe_plan_id' => 'price_1Rqcbi79GGvBrptVJNU7qfOQ',
            ]);
        }
    }
    }
}
