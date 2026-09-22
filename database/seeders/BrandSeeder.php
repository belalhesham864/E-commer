<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{


    public function run(): void
    {
       $brands = [
            ['name' => ['en' => 'Palxohs',  'ar' => 'بالكسوهس'],   'logo' => 'Palxohs.webp'],
            ['name' => ['en' => 'Oyarx',    'ar' => 'أويارإكس'],   'logo' => 'Oyarx.webp'],
            ['name' => ['en' => 'Aplio',    'ar' => 'أبليو'],      'logo' => 'Aplio.webp'],
            ['name' => ['en' => 'Toyuos',   'ar' => 'تويوس'],      'logo' => 'Toyuos.webp'],
            ['name' => ['en' => 'Maxtoxie', 'ar' => 'ماكستوكسي'],  'logo' => 'Maxtoxie.webp'],
            ['name' => ['en' => 'Swaariy',  'ar' => 'سواري'],      'logo' => 'Swaariy.webp'],
            ['name' => ['en' => 'Roxxye',   'ar' => 'روكسي'],      'logo' => 'Roxxye.webp'],
            ['name' => ['en' => 'Sidkkow',  'ar' => 'سيدكاو'],     'logo' => 'Sidkkow.webp'],
            ['name' => ['en' => 'Pixxley',  'ar' => 'بيكسلي'],     'logo' => 'Pixxley.webp'],
            ['name' => ['en' => 'Jaksey',   'ar' => 'جاكسي'],      'logo' => 'Jaksey.webp'],
            ['name' => ['en' => 'Odsxym',   'ar' => 'أودسيم'],     'logo' => 'Odsxym.webp'],
            ['name' => ['en' => 'Paparic',  'ar' => 'باباريك'],    'logo' => 'Paparic.webp'],
        ];

foreach ($brands as $brand) {
    Brand::create($brand);
}
    }
}
