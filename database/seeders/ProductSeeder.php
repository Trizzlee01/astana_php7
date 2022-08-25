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
                'id_productType' => 1,
                'id_group' => 1,
                'stok' => 0,
                'harga_jual' => 25000,
                'harga_modal' => 20000,
                'keterangan' => 'Kosong',
            ],
            [
                'id_productType' => 2,
                'id_group' => 1,
                'stok' => 0,
                'harga_jual' => 20000,
                'harga_modal' => 15000,
                'keterangan' => 'Kosong',
            ],
            [
                'id_productType' => 3,
                'id_group' => 1,
                'stok' => 0,
                'harga_jual' => 20000,
                'harga_modal' => 10000,   
                'keterangan' => 'Kosong',
            ],
            [
                'id_productType' => 4,
                'id_group' => 1,
                'stok' => 0,
                'harga_jual' => 15000,
                'harga_modal' => 8000,   
                'keterangan' => 'Kosong',
            ],
            [
                'id_productType' => 5,
                'id_group' => 1,
                'stok' => 0,
                'harga_jual' => 10000,
                'harga_modal' => 5000,   
                'keterangan' => 'Kosong',
            ],
            [
                'id_productType' => 1,
                'id_group' => 2,
                'stok' => 250,
                'harga_jual' => 25000,
                'harga_modal' => 20000,
                'keterangan' => 'keterangan parfum 1',
            ],
            [
                'id_productType' => 2,
                'id_group' => 2,
                'stok' => 100,
                'harga_jual' => 20000,
                'harga_modal' => 15000,
                'keterangan' => 'keterangan parfum 2',
            ],
            [
                'id_productType' => 3,
                'id_group' => 2,
                'stok' => 150,
                'harga_jual' => 0,
                'harga_modal' => 0,   
                'keterangan' => 'keterangan parfum 3',
            ],
            [
                'id_productType' => 4,
                'id_group' => 2,
                'stok' => 0,
                'harga_jual' => 0,
                'harga_modal' => 0,   
                'keterangan' => 'keterangan parfum 3',
            ],
            [
                'id_productType' => 5,
                'id_group' => 2,
                'stok' => 0,
                'harga_jual' => 0,
                'harga_modal' => 0,   
                'keterangan' => 'keterangan parfum 3',
            ],
            [
                'id_productType' => 1,
                'id_group' => 3,
                'stok' => 250,
                'harga_jual' => 25000,
                'harga_modal' => 20000,
                'keterangan' => 'keterangan parfum 1',
            ],
            [
                'id_productType' => 2,
                'id_group' => 3,
                'stok' => 100,
                'harga_jual' => 20000,
                'harga_modal' => 15000,
                'keterangan' => 'keterangan parfum 2',
            ],
            [
                'id_productType' => 3,
                'id_group' => 3,
                'stok' => 150,
                'harga_jual' => 0,
                'harga_modal' => 0,   
                'keterangan' => 'keterangan parfum 3',
            ],
            [
                'id_productType' => 4,
                'id_group' => 3,
                'stok' => 0,
                'harga_jual' => 0,
                'harga_modal' => 0,   
                'keterangan' => 'keterangan parfum 3',
            ],
            [
                'id_productType' => 5,
                'id_group' => 3,
                'stok' => 0,
                'harga_jual' => 0,
                'harga_modal' => 0,   
                'keterangan' => 'keterangan parfum 3',
            ],
        ];
        

        foreach($products as $product){
            Product::create($product);
        }
    }
}
