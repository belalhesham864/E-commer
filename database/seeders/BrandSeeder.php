<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
  DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    Brand::truncate();

    DB::statement('SET FOREIGN_KEY_CHECKS=1;')
    public function run(): void
    {
        $brands = [
    [
        'name' => ['en' => 'Apple', 'ar' => 'آبل'],
        'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Apple-Logo.png',
    ],
    [
        'name' => ['en' => 'Google', 'ar' => 'جوجل'],
        'logo' => 'https://logos-world.net/wp-content/uploads/2020/09/Google-Logo.png',
    ],
    [
        'name' => ['en' => 'Samsung', 'ar' => 'سامسونج'],
        'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Samsung-Logo.png',
    ],
    [
        'name' => ['en' => 'Xiaomi', 'ar' => 'شاومي'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/Xiaomi_logo.svg',
    ],
    [
        'name' => ['en' => 'OnePlus', 'ar' => 'ون بلس'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/ab/OnePlus_logo.svg',
    ],
    [
        'name' => ['en' => 'Oppo', 'ar' => 'أوبو'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6e/OPPO_LOGO_2019.svg',
    ],
    [
        'name' => ['en' => 'Realme', 'ar' => 'ريلمي'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c9/Realme_logo.svg',
    ],
    [
        'name' => ['en' => 'Huawei', 'ar' => 'هواوي'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/en/0/04/Huawei_Standard_logo.svg',
    ],
    [
        'name' => ['en' => 'Lenovo', 'ar' => 'لينوفو'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/b/b8/Lenovo_logo_2015.svg',
    ],
    [
        'name' => ['en' => 'Dell', 'ar' => 'ديل'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/48/Dell_Logo.svg',
    ],
    [
        'name' => ['en' => 'HP', 'ar' => 'إتش بي'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/HP_logo_2012.svg',
    ],
    [
        'name' => ['en' => 'Asus', 'ar' => 'أسوس'],
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/ASUS_Logo.svg',
    ],
];

foreach ($brands as $brand) {
    Brand::create($brand);
}
    }
}
