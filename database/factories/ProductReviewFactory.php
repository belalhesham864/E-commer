<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment'    => $this->faker->sentence(rand(8, 20)),
            'product_id' => Product::inRandomOrder()->value('id'),
            'user_id'    => User::inRandomOrder()->value('id'),
        ];
    }
}

