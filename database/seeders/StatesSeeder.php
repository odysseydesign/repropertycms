<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('states')->count() > 0) {
            return;
        }

        $now = now();

        $states = [
            ['name' => 'Alabama', 'code' => 'AL'],
            ['name' => 'Alaska', 'code' => 'AK'],
            ['name' => 'Alberta', 'code' => 'AB'],
            ['name' => 'American Samoa', 'code' => 'AS'],
            ['name' => 'Arizona', 'code' => 'AZ'],
            ['name' => 'Arkansas', 'code' => 'AR'],
            ['name' => 'British Columbia', 'code' => 'BC'],
            ['name' => 'California', 'code' => 'CA'],
            ['name' => 'Caroline ISLANDS', 'code' => 'PW'],
            ['name' => 'Colorado', 'code' => 'CO'],
            ['name' => 'Conneticut', 'code' => 'CT'],
            ['name' => 'Delaware', 'code' => 'DE'],
            ['name' => 'District of Columbia', 'code' => 'DC'],
            ['name' => 'Federated State', 'code' => 'FM'],
            ['name' => 'Florida', 'code' => 'FL'],
            ['name' => 'Georgia', 'code' => 'GA'],
            ['name' => 'Guam', 'code' => 'GU'],
            ['name' => 'Hawaii', 'code' => 'HI'],
            ['name' => 'Idoha', 'code' => 'ID'],
            ['name' => 'Illinois', 'code' => 'IL'],
            ['name' => 'Indiana', 'code' => 'IN'],
            ['name' => 'Iowa', 'code' => 'IA'],
            ['name' => 'Kansas', 'code' => 'KS'],
            ['name' => 'Kentucky', 'code' => 'KY'],
            ['name' => 'Lousiana', 'code' => 'LA'],
            ['name' => 'Maine', 'code' => 'ME'],
            ['name' => 'Manitoba', 'code' => 'MB'],
            ['name' => 'Mariana Islands', 'code' => 'MP'],
            ['name' => 'Marshall Islands', 'code' => 'MH'],
            ['name' => 'Maryland', 'code' => 'MD'],
            ['name' => 'Massachusetts', 'code' => 'MA'],
            ['name' => 'Illmichiganinois', 'code' => 'MI'],
            ['name' => 'Minnesota', 'code' => 'MN'],
            ['name' => 'Mississippi', 'code' => 'MS'],
            ['name' => 'Missouri', 'code' => 'MO'],
            ['name' => 'Montana', 'code' => 'MT'],
            ['name' => 'Nebraska', 'code' => 'NE'],
            ['name' => 'Nevada', 'code' => 'NV'],
            ['name' => 'New Brunswick', 'code' => 'NB'],
            ['name' => 'New Hampshire', 'code' => 'NH'],
            ['name' => 'New Jersey', 'code' => 'NJ'],
            ['name' => 'New Mexico', 'code' => 'NM'],
            ['name' => 'New York', 'code' => 'NY'],
            ['name' => 'Newfoundland', 'code' => 'NF'],
            ['name' => 'North Carlolina', 'code' => 'NC'],
            ['name' => 'North Dakota', 'code' => 'ND'],
            ['name' => 'Northwest Territories', 'code' => 'NT'],
            ['name' => 'Nova Scotia', 'code' => 'NS'],
            ['name' => 'Nunavut', 'code' => 'NU'],
            ['name' => 'Ohio', 'code' => 'OH'],
            ['name' => 'Oklahoma', 'code' => 'OK'],
            ['name' => 'Ontario', 'code' => 'ON'],
            ['name' => 'Oregon', 'code' => 'OR'],
            ['name' => 'Pennsylvania', 'code' => 'PA'],
            ['name' => 'Prince Edward Island', 'code' => 'PE'],
            ['name' => 'Puerto Rica', 'code' => 'PR'],
            ['name' => 'Quebec', 'code' => 'PQ'],
            ['name' => 'Rhode Island', 'code' => 'RI'],
            ['name' => 'Saskatchewan', 'code' => 'SK'],
            ['name' => 'South Carolina', 'code' => 'SC'],
            ['name' => 'South Dakota', 'code' => 'SD'],
            ['name' => 'Tennessee', 'code' => 'TN'],
            ['name' => 'Texas', 'code' => 'TX'],
            ['name' => 'Utah', 'code' => 'UT'],
            ['name' => 'Vermont', 'code' => 'VT'],
            ['name' => 'Virgin Islands', 'code' => 'VI'],
            ['name' => 'Virginia', 'code' => 'VA'],
            ['name' => 'Washington', 'code' => 'WA'],
            ['name' => 'West Virgania', 'code' => 'WV'],
            ['name' => 'Wisconsin', 'code' => 'WI'],
            ['name' => 'Wyoming', 'code' => 'WY'],
            ['name' => 'Yukon Territory', 'code' => 'YT'],
            ['name' => 'Armed Forces - EUROPE', 'code' => 'AE'],
            ['name' => 'Armed Forces - AMERICAS', 'code' => 'AA'],
            ['name' => 'Armed Forces - PACIFIC', 'code' => 'AP'],
        ];

        $rows = array_map(fn($s) => array_merge($s, ['created_at' => $now, 'updated_at' => $now]), $states);

        DB::table('states')->insert($rows);
    }
}
