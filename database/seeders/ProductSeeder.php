<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Cimol Original',
                'description' => 'Cimol klasik tanpa rasa tambahan.',
                'price' => 8000,
                'image' => 'cimol_3.jpg', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cimol Ayam',
                'description' => 'Pedas nikmat dengan potongan daging ayam.',
                'price' => 9000,
                'image' => 'cimol_2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cimol Mozarella',
                'description' => 'Cimol dengan isi keju mozarella.',
                'price' => 10000,
                'image' => 'cimol_1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
