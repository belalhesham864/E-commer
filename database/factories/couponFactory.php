<?php

namespace Database\Factories;

use App\Models\coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<coupon>
 */
class couponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start=now()->addDays(random_int(1,4));
        $limit=$this->faker->numberBetween(1,100);
        return [
            'code'=>$this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'discount_precentage'=>$this->faker->numberBetween(10,50),
            'is_active'=>$this->faker->boolean(),
            'start_date'=>$start,
            'end_date'=>$start->copy()->addDays(random_int(1,30)),
            'limit'=>$limit,
            'time_used'=>$this->faker->numberBetween(0,$limit),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
