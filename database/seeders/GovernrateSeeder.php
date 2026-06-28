<?php

namespace Database\Seeders;

use App\Models\Governrate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('governrates')->truncate();
        $governrates=[
[
    
        'country_id' => 1,
        'name' => [
            'ar' => 'الدقهلية',
            'en' => 'Dakahlia',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'البحر الأحمر',
            'en' => 'Red Sea',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'البحيرة',
            'en' => 'Beheira',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الفيوم',
            'en' => 'Faiyum',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الغربية',
            'en' => 'Gharbia',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الإسكندرية',
            'en' => 'Alexandria',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الإسماعيلية',
            'en' => 'Ismailia',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الجيزة',
            'en' => 'Giza',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'المنوفية',
            'en' => 'Monufia',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'المنيا',
            'en' => 'Minya',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'القاهرة',
            'en' => 'Cairo',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'القليوبية',
            'en' => 'Qalyubia',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الوادي الجديد',
            'en' => 'New Valley',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الشرقية',
            'en' => 'Sharqia',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'السويس',
            'en' => 'Suez',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'أسوان',
            'en' => 'Aswan',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'أسيوط',
            'en' => 'Asyut',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'بني سويف',
            'en' => 'Beni Suweif',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'بور سعيد',
            'en' => 'Port Said',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'دمياط',
            'en' => 'Damietta',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'كفر الشيخ',
            'en' => 'Kafr el-Sheikh',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'مطروح',
            'en' => 'Matruh',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'قنا',
            'en' => 'Qena',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'سوهاج',
            'en' => 'Sohag',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'جنوب سيناء',
            'en' => 'South Sinai',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'شمال سيناء',
            'en' => 'North Sinai',
        ],
    ],
    [
        'country_id' => 1,
        'name' => [
            'ar' => 'الأقصر',
            'en' => 'Luxor',
        ],
    ],

        ];


        foreach($governrates as $governrate){
            Governrate::create($governrate);
        }
    }
}
