<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'role_id'=>1
        ]);
        Admin::create([
            'name'=>'belal',
            'email'=>'belalhesham619@gmail.com',
            'password'=>Hash::make('password'),
            'role_id'=>1
        ]);
    }
}
