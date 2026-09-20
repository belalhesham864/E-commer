<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'name' => [
                    'en' => 'Dresses',
                    'ar' => 'فساتين',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'dresses.webp',
            ],

            [
                'name' => [
                    'en' => 'Leather Bags',
                    'ar' => 'حقائب جلدية',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'bags.webp',
            ],

            [
                'name' => [
                    'en' => 'Sweaters',
                    'ar' => 'بلوفرات',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'sweaters.webp',
            ],

            [
                'name' => [
                    'en' => 'Boots',
                    'ar' => 'أحذية بوت',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'shoes.webp',
            ],

            [
                'name' => [
                    'en' => 'Gift for Him',
                    'ar' => 'هدايا للرجال',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'gift.webp',
            ],

            [
                'name' => [
                    'en' => 'Sneakers',
                    'ar' => 'أحذية رياضية',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'sneakers.webp',
            ],

            [
                'name' => [
                    'en' => 'Watch',
                    'ar' => 'ساعات',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'watch.webp',
            ],

            [
                'name' => [
                    'en' => 'Gold Rings',
                    'ar' => 'خواتم ذهب',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'ring.webp',
            ],

            [
                'name' => [
                    'en' => 'Cap',
                    'ar' => 'كاب',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'cap.webp',
            ],

            [
                'name' => [
                    'en' => 'Sunglass',
                    'ar' => 'نظارات شمسية',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'glass.webp',
            ],

            [
                'name' => [
                    'en' => 'Baby Shop',
                    'ar' => 'مستلزمات الأطفال',
                ],
                'status' => 1,
                'parent' => null,
                'icon' => 'baby.webp',
            ],



        ];
        foreach ($data as $category) {
            category::create($category);
        }
    }
}
