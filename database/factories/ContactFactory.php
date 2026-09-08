<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user=User::inRandomOrder()->first();
        return [
            'name'=>$user->name,
            'email'=>$user->email,
            'phone'=>$user->phone,
            'subject'=>fake()->sentence(3),
            'message'=>fake()->sentence(10),
            'user_id'=>$user->id,
            'is_start'=>rand(0,1),
        ];
    }
}
