<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'price' => 100,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'price' => 150,
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description for Product 3',
                'price' => 200,
            ],
        ];
        Product::insert($products);
    }
}
