<?php

namespace Database\Seeders;

use App\Models\page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        page::create([
            'title'=>'Privacy Policy',
            'content'=>'Terms and conditions typically have a short description of your privacy policy',
            'image'=>'page1.jpg'
                    ]);
        page::create([
            'title'=>'Question Answer',
            'content'=>'Terms and conditions typically have a short description of your privacy policy',
            'image'=>'page2.jpg'
                    ]);
    }
}
