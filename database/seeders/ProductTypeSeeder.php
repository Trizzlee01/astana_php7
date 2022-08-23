<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'kode_produk' => 'P1',
                'nama_produk' => 'Parfum 1',
            ],
            [
                'kode_produk' => 'P2',
                'nama_produk' => 'Parfum 2',
            ],
            [
                'kode_produk' => 'P3',
                'nama_produk' => 'Parfum 3',
            ],
            [
                'kode_produk' => 'P4',
                'nama_produk' => 'Parfum 4',
            ],
            [
                'kode_produk' => 'P5',
                'nama_produk' => 'Parfum 5',
            ],
        ];

        foreach($types as $type){
            ProductType::create($type);
        }
    }
}
