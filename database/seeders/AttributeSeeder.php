<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $size=Attribute::create([
            'name'=>'size'
        ]);
        $size->attributevalues()->createMany([
            ['value'=>'S'],
            ['value'=>'L'],
            ['value'=>'XL'],
            ['value'=>'2XL'],
        ]);
          $color=Attribute::create([
            'name'=>'color'
        ]);
        $color->attributevalues()->createMany([
            ['value'=>'red'],
            ['value'=>'blue'],
            ['value'=>'green'],
            ['value'=>'black'],
            ['value'=>'white'],
        ]);
    }
}
