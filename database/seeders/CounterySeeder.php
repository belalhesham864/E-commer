<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CounterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('countries')->truncate();
        $countries = [
            [

                'name' => ['en' => 'egypt', 'ar' => 'مصر'],
                'phone_code' => '20',
            ],

        ];
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
