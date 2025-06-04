<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'name' => "Product $i",
                'description' => "Product Number $i.",
                'price' => rand(10000, 500000),
                'stock' => rand(0, 50),
                'category_id' => rand(1, 3),
            ]);
        }
    }
}
