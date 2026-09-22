<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\productVarient;
use App\Models\VarientAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = category::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        if (empty($categories) || empty($brands)) {
            return;
        }

        $sizes = AttributeValue::whereHas('attribute', function ($q) {
            $q->where('name', 'size');
        })->get();

        $colors = AttributeValue::whereHas('attribute', function ($q) {
            $q->where('name', 'color');
        })->get();

        $productsData = [
            [
                'name' => 'Leather Handbag Classic',
                'small_desc' => 'Premium genuine leather handbag for daily elegance.',
                'desc' => 'Crafted with finest Italian leather, featuring durable stitching, spacious inner compartments, and gold-tone hardware.',
                'has_variants' => 0,
                'price' => 149.99,
                'has_discount' => 1,
                'discount' => 20.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(30),
                'quantity' => 25,
                'images' => ['product-img-1.webp', 'product-slider-img-1.webp'],
            ],
            [
                'name' => 'Casual Cotton T-Shirt',
                'small_desc' => '100% breathable organic cotton t-shirt.',
                'desc' => 'Super soft and comfortable t-shirt suitable for all seasons. Available in multiple sizes and colors.',
                'has_variants' => 1,
                'price' => null,
                'has_discount' => 0,
                'discount' => null,
                'start_discount' => null,
                'end_discount' => null,
                'quantity' => null,
                'images' => ['product-img-2.webp'],
            ],
            [
                'name' => 'Casual1 Cotton T-Shirt',
                'small_desc' => '100% breathable organic cotton t-shirt.',
                'desc' => 'Super soft and comfortable t-shirt suitable for all seasons. Available in multiple sizes and colors.',
                'has_variants' => 1,
                'price' => null,
                'has_discount' => 0,
                'discount' => null,
                'start_discount' => null,
                'end_discount' => null,
                'quantity' => null,
                'images' => ['product-img-2.webp'],
            ],
            [
                'name' => 'Modern1 Denim Jacket',
                'small_desc' => 'Stylish streetwear denim jacket with modern cut.',
                'desc' => 'High quality washed denim fabric with branded buttons and comfortable lining.',
                'has_variants' => 0,
                'price' => 89.50,
                'has_discount' => 1,
                'discount' => 20.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(30),
                'quantity' => 15,
                'images' => ['product-img-3.webp'],
            ],
            [
                'name' => 'Modern2 Denim Jacket',
                'small_desc' => 'Stylish streetwear denim jacket with modern cut.',
                'desc' => 'High quality washed denim fabric with branded buttons and comfortable lining.',
                'has_variants' => 0,
                'price' => 89.50,
                'has_discount' => 1,
                'discount' => 20.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(30),
                'quantity' => 15,
                'images' => ['product-img-9.webp'],
            ],
            [
                'name' => 'Modern3 Denim Jacket',
                'small_desc' => 'Stylish streetwear denim jacket with modern cut.',
                'desc' => 'High quality washed denim fabric with branded buttons and comfortable lining.',
                'has_variants' => 0,
                'price' => 89.50,
                'has_discount' => 1,
                'discount' => 20.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(30),
                'quantity' => 15,
                'images' => ['product-img-5.webp'],
            ],
            [
                'name' => 'Modern5 Denim Jacket',
                'small_desc' => 'Stylish streetwear denim jacket with modern cut.',
                'desc' => 'High quality washed denim fabric with branded buttons and comfortable lining.',
                'has_variants' => 0,
                'price' => 89.50,
                'has_discount' => 1,
                'discount' => 20.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(30),
                'quantity' => 15,
                'images' => ['product-img-5.webp'],
            ],
            [
                'name' => 'Modern8 Denim Jacket',
                'small_desc' => 'Stylish streetwear denim jacket with modern cut.',
                'desc' => 'High quality washed denim fabric with branded buttons and comfortable lining.',
                'has_variants' => 0,
                'price' => 89.50,
                'has_discount' => 1,
                'discount' => 20.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(30),
                'quantity' => 15,
                'images' => ['product-img-3.webp'],
            ],
            [
                'name' => 'Athletic Running Sneakers',
                'small_desc' => 'Ultra-light cushioning sneakers for running and fitness.',
                'desc' => 'Engineered mesh upper for maximum airflow, responsive foam midsole, and durable rubber outsole.',
                'has_variants' => 1,
                'price' => null,
                'has_discount' => 0,
                'discount' => null,
                'start_discount' => null,
                'end_discount' => null,
                'quantity' => null,
                'images' => ['product-img-4.webp', 'product-slider-img-2.webp'],
            ],
            [
                'name' => 'Minimalist Gold Watch',
                'small_desc' => 'Sleek luxury quartz watch with stainless steel strap.',
                'desc' => 'Water resistant up to 50 meters, scratch-resistant sapphire glass, and precision Japanese quartz movement.',
                'has_variants' => 0,
                'price' => 199.00,
                'has_discount' => 1,
                'discount' => 35.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(15),
                'quantity' => 10,
                'images' => ['product-img-5.webp'],
            ],
            [
                'name' => 'Floral Summer Dress',
                'small_desc' => 'Light and breezy floral print maxi dress.',
                'desc' => 'Made from soft flowing chiffon, elasticated waistline, and vibrant colors perfect for summer outings.',
                'has_variants' => 1,
                'price' => null,
                'has_discount' => 0,
                'discount' => null,
                'start_discount' => null,
                'end_discount' => null,
                'quantity' => null,
                'images' => ['product-img-6.webp'],
            ],
            [
                'name' => 'Smart Fitness Tracker',
                'small_desc' => 'All-day activity and health monitor with AMOLED display.',
                'desc' => 'Heart rate monitoring, sleep tracking, 30+ sport modes, and 14-day battery life on a single charge.',
                'has_variants' => 0,
                'price' => 59.99,
                'has_discount' => 1,
                'discount' => 15.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(20),
                'quantity' => 50,
                'images' => ['product-img-7.webp'],
            ],
            [
                'name' => 'Wool Knit Winter Sweater',
                'small_desc' => 'Cozy ribbed knit sweater with turtleneck collar.',
                'desc' => 'Warm blend of merino wool and cashmere, relaxed silhouette, and ribbed cuffs for extra warmth.',
                'has_variants' => 1,
                'price' => null,
                'has_discount' => 0,
                'discount' => null,
                'start_discount' => null,
                'end_discount' => null,
                'quantity' => null,
                'images' => ['product-img-8.webp'],
            ],
            [
                'name' => 'Designer Aviator Sunglasses',
                'small_desc' => 'UV400 polarized lenses with lightweight titanium frame.',
                'desc' => 'Classic pilot silhouette, anti-glare coating, and adjustable silicone nose pads for maximum comfort.',
                'has_variants' => 0,
                'price' => 75.00,
                'has_discount' => 1,
                'discount' => 15.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(20),
                'quantity' => 30,
                'images' => ['product-img-9.webp'],
            ],
            [
                'name' => 'Slim Fit Chino Pants',
                'small_desc' => 'Comfort stretch cotton chinos for casual or formal wear.',
                'desc' => '98% cotton 2% elastane for flexible movement, tapered leg fit, and deep functional pockets.',
                'has_variants' => 1,
                'price' => null,
                'has_discount' => 0,
                'discount' => null,
                'start_discount' => null,
                'end_discount' => null,
                'quantity' => null,
                'images' => ['product-img-10.webp'],
            ],
            [
                'name' => 'Wireless Noise-Cancelling Headphones',
                'small_desc' => 'Over-ear Bluetooth headphones with active noise cancellation.',
                'desc' => 'Hi-Res audio drivers, 40 hours playtime, fast USB-C charging, and memory foam ear cushions.',
                'has_variants' => 0,
                'price' => 129.99,
                'has_discount' => 1,
                'discount' => 30.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(25),
                'quantity' => 20,
                'images' => ['product-img-11.webp', 'product-slider-img-3.webp'],
            ],
            [
                'name' => 'Waterproof Hiking Backpack',
                'small_desc' => '35L lightweight outdoor backpack with rain cover.',
                'desc' => 'Ripstop nylon construction, breathable mesh back panel, trekking pole attachments, and hydration bladder sleeve.',
                'has_variants' => 0,
                'price' => 64.99,
                'has_discount' => 1,
                'discount' => 10.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(10),
                'quantity' => 18,
                'images' => ['product-img-12.webp'],
            ],
            [
                'name' => 'Silk Button-Down Blouse',
                'small_desc' => 'Elegant pure silk long-sleeve blouse.',
                'desc' => 'Luxurious drape and soft feel, mother-of-pearl buttons, and tailored cuffs for office and evening wear.',
                'has_variants' => 1,
                'price' => null,
                'has_discount' => 0,
                'discount' => null,
                'start_discount' => null,
                'end_discount' => null,
                'quantity' => null,
                'images' => ['product-img-13.webp'],
            ],
            [
                'name' => 'Classic Leather Belt',
                'small_desc' => 'Full-grain leather belt with brushed brass buckle.',
                'desc' => 'Handcrafted solid leather strap, timeless design that pairs well with denim or dress trousers.',
                'has_variants' => 0,
                'price' => 39.99,
                'has_discount' => 1,
                'discount' => 10.00,
                'start_discount' => now(),
                'end_discount' => now()->addDays(15),
                'quantity' => 40,
                'images' => ['product-img-14.webp'],
            ],
        ];

        foreach ($productsData as $index => $data) {
            $catId = $categories[$index % count($categories)];
            $brandId = $brands[$index % count($brands)];

            $product = Product::create([
                'name' => $data['name'],
                'small_desc' => $data['small_desc'],
                'desc' => $data['desc'],
                'status' => 1,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'available_for' => now()->addYear(),
                'views' => rand(10, 500),
                'has_variants' => $data['has_variants'],
                'price' => $data['price'],
                'has_discount' => $data['has_discount'],
                'discount' => $data['discount'],
                'start_discount' => $data['start_discount'],
                'end_discount' => $data['end_discount'],
                'manage_stock' => 1,
                'quantity' => $data['quantity'],
                'available_in_stock' => 1,
                'category_id' => $catId,
                'brand_id' => $brandId,
            ]);

            // Save Product Images
            foreach ($data['images'] as $imageName) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_name' => $imageName,
                ]);
            }

            // If product has variants, create combinations of variants
            if ($data['has_variants'] == 1 && $sizes->isNotEmpty() && $colors->isNotEmpty()) {
                $chosenSizes = $sizes->take(2);
                $chosenColors = $colors->take(2);

                $variantPrices = [49.99, 54.99, 59.99, 64.99];
                $pIndex = 0;

                foreach ($chosenSizes as $size) {
                    foreach ($chosenColors as $color) {
                        $variant = productVarient::create([
                            'product_id' => $product->id,
                            'price' => $variantPrices[$pIndex % count($variantPrices)],
                            'stock' => rand(5, 30),
                        ]);
                        $pIndex++;

                        VarientAttribute::create([
                            'product_varient_id' => $variant->id,
                            'attribute_value_id' => $size->id,
                        ]);

                        VarientAttribute::create([
                            'product_varient_id' => $variant->id,
                            'attribute_value_id' => $color->id,
                        ]);
                    }
                }
            }
        }
    }
}
