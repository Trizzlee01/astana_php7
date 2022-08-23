<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                'product_type_id' => 1,
                'stok' => 250,
                'harga_jual' => 25000,
                'harga_modal' => 20000,
                'keterangan' => 'keterangan parfum 1',
            ],
            [
                'product_type_id' => 2,
                'stok' => 100,
                'harga_jual' => 20000,
                'harga_modal' => 15000,
                'keterangan' => 'keterangan parfum 2',
            ],
            [
                'product_type_id' => 3,
                'stok' => 150,
                'harga_jual' => 30000,
                'harga_modal' => 25000,   
                'keterangan' => 'keterangan parfum 3',
            ],
        ];
        

        foreach($products as $product){
            Product::create($product);
        }
    }
}
