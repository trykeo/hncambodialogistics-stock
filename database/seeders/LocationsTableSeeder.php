<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'id'      => 1,
                'country' => 'thailand',
                'name'    => 'HN Warehouse',
                'address' => 'Bangkok, Thailand',
                'code'    => 'L01',
            ],
            [
                'id'      => 2,
                'country' => 'cambodia',
                'name'    => 'Phnom Penh',
                'address' => 'Phnom Penh, Cambodia',
                'code'    => 'L02',
            ],
        ];

        Location::insert($locations);
    }
}
