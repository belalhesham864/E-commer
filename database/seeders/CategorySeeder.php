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
      $data=[
        [
            'name'=>['en'=>'category','ar'=>'التصنيف'],
            'status'=>1,
            'parent'=>null
        ],
        [
            'name'=>['en'=>'category2','ar'=>'2التصنيف'],
            'status'=>1,
            'parent'=>null
        ],
        [
            'name'=>['en'=>'category3','ar'=>'التصنيف3'],
            'status'=>1,
            'parent'=>null
        ],
        [
            'name'=>['en'=>'category4','ar'=>'4التصنيف'],
            'status'=>1,
            'parent'=>null
        ],
      ];
      foreach($data as $category){
        category::create($category);
      }
    }
}
