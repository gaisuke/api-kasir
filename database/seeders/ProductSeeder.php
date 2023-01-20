<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++){
            Product::create([
                'name' => 'Product '.$i,
                'slug' => Str::slug('Product '.$i),
                'price' => $i * 1000,
                'stock' => 100
            ]);
        }
    }
}
