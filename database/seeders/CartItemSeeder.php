<?php

namespace Database\Seeders;

use App\Models\cart;
use App\Models\cartItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = cart::all();
        if ($carts->isEmpty()) {
            return;
        }

        $products = Product::with(['Variants.VarientAttributes.AttributeValue.attribute'])
            ->where('status', 1)
            ->get();

        if ($products->isEmpty()) {
            return;
        }

        foreach ($carts as $cart) {
            // Pick 2 to 4 random products for this cart
            $randomProducts = $products->random(min(rand(2, 4), $products->count()));

            foreach ($randomProducts as $product) {
                if ($product->has_variants && $product->Variants->isNotEmpty()) {
                    // Pick a random variant
                    $variant = $product->Variants->random();

                    // Collect variant attributes (e.g. ['size' => 'XL', 'color' => 'Red'])
                    $attributes = [];
                    foreach ($variant->VarientAttributes as $va) {
                        if ($va->AttributeValue && $va->AttributeValue->attribute) {
                            $attributes[$va->AttributeValue->attribute->name] = $va->AttributeValue->value;
                        }
                    }

                    cartItem::firstOrCreate(
                        [
                            'cart_id'            => $cart->id,
                            'product_id'         => $product->id,
                            'product_variant_id' => $variant->id,
                        ],
                        [
                            'price'      => (float) $variant->price,
                            'quantity'   => rand(1, 3),
                            'attributes' => !empty($attributes) ? $attributes : null,
                        ]
                    );
                } else {
                    // Simple product
                    $price = method_exists($product, 'getPriceAfterDiscount')
                        ? (float) $product->getPriceAfterDiscount()
                        : (float) $product->getRawOriginal('price');

                    cartItem::firstOrCreate(
                        [
                            'cart_id'            => $cart->id,
                            'product_id'         => $product->id,
                            'product_variant_id' => null,
                        ],
                        [
                            'price'      => $price,
                            'quantity'   => rand(1, 3),
                            'attributes' => null,
                        ]
                    );
                }
            }
        }
    }
}
