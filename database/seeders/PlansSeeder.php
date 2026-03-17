<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('plans')->count() > 0) {
            return;
        }

        $now = now();

        DB::table('plans')->insert([
            [
                'name'        => 'Starter',
                'description' => '1 Property listing. Month to month recurring subscription. Cancel at anytime. Billed monthly.',
                'price'       => 29.00,
                'credits'     => 1,
                'interval'    => 'month',
                'active'      => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Enhanced',
                'description' => 'Up to 5 Property listings. Month to month recurring subscription. Cancel at anytime.',
                'price'       => 53.00,
                'credits'     => 5,
                'interval'    => 'month',
                'active'      => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Enterprise',
                'description' => 'Up to 30 Property listings. Month to month recurring subscription. Cancel at anytime.',
                'price'       => 130.00,
                'credits'     => 30,
                'interval'    => 'month',
                'active'      => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);
    }
}
