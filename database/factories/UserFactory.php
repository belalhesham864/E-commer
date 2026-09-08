<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country=Country::inRandomOrder()->first();
        if(!$country){
            throw new \Exception('No country found please seed country in DB');
        }
        $governrate=$country->governrates()->inRandomOrder()->first();
               if(!$governrate){
            throw new \Exception("No governrate found in {$country->id}please seed governrate in DB");
        }
        $city=$governrate->cities()->inRandomOrder()->first();
               if(!$city){
            throw new \Exception("No cities found in {$governrate->id}please seed city in DB");
        }
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone'=> fake()->regexify('01[0125][0-9]{8}'),
            'country_id' => $country->id,
            'governrate_id' => $governrate->id,
            'city_id' => $city->id,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
