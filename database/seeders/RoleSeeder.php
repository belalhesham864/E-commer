<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permessions = [];
        foreach (config('Permissions_ar') as $permession => $value) {
            $permessions[] = $permession;
        }
        Role::create([
            'role' => [
                'ar' => 'مدير',
                'en' => 'Manger'
            ],

            'permession' => json_encode($permessions)
        ]);
    }
}
