<?php

namespace Database\Seeders;

use App\Models\cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return;
        }

        // Create or get a cart for each user (taking up to 10 users)
        foreach ($users->take(10) as $user) {
            cart::firstOrCreate([
                'user_id' => $user->id,
            ]);
        }

        // Seed items into the carts
        $this->call(CartItemSeeder::class);
    }
}
