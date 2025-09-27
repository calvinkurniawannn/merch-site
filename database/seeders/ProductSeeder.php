<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'image' => 'images/products/headphones.jpg', 
                'name' => 'Wireless Headphones',
                'description' => 'Noise-cancelling over-ear headphones with 30 hours of battery life.',
                'price' => 1250000.00,
                'quantity' => 15,
                'store_id' => 1,
                'modified_by' => 'system',
                'modified_date' => now(),
                'created_by' => 'system',
                'created_date' => now(),
                'slug'=>'asdkjasdjadka123123'
            ],
            [
                'image' => 'images/products/backpack.jpg',
                'name' => 'Leather Backpack',
                'description' => 'Durable leather backpack with laptop compartment, perfect for work or travel.',
                'price' => 850000.00,
                'quantity' => 25,
                'store_id' => 1,
                'modified_by' => 'system',
                'modified_date' => now(),
                'created_by' => 'system',
                'created_date' => now(),
                'slug'=>'adnsandsad8asd8sa8'
            ],
            [
                'image' => 'images/products/smartwatch.jpg',
                'name' => 'Smart Watch',
                'description' => 'Water-resistant smartwatch with heart-rate monitor and fitness tracking.',
                'price' => 1750000.00,
                'quantity' => 10,
                'store_id' => 1,
                'modified_by' => 'system',
                'modified_date' => now(),
                'created_by' => 'system',
                'created_date' => now(),
                'slug'=>'askdajkda88181818'
            ],
        ]);
    }
}