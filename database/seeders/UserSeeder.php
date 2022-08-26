<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Schema as FacadesSchema;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // FacadesSchema::disableForeignKeyConstraints();
        $users = [
            [
                'user_position' => 'superadmin_pabrik',
                'id_group' => 1,
                'username' => 'superadmin',
                'password' => bcrypt('12345'),
                'firstname' => 'Superadmin',
                'lastname' => 'Astana',
                'ktp' => '0000000000000000',
                'email' => 'deuscode@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 0,
                'nama_input' => 'Default System',
            ],
            [
                'user_position' => 'superadmin_pabrik',
                'id_group' => 1,
                'username' => 'superadmin2',
                'password' => bcrypt('12345'),
                'firstname' => 'Superadmin',
                'lastname' => 'Astana2',
                'ktp' => '0000000000000001',
                'email' => 'deuscode2@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 1,
                'nama_input' => 'Superadmin Astana',
            ],
            [
                'user_position' => 'accounting_pabrik',
                'id_group' => 1,
                'username' => 'accountingdeuscode',
                'password' => bcrypt('12345'),
                'firstname' => 'Accounting',
                'lastname' => 'Deuscode',
                'ktp' => '0000000000000002',
                'email' => 'accountingdeuscode@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 1,
                'nama_input' => 'Superadmin Astana',
            ],
            [
                'user_position' => 'cashier_pabrik',
                'id_group' => 1,
                'username' => 'kasirdeuscode',
                'password' => bcrypt('12345'),
                'firstname' => 'Kasir',
                'lastname' => 'Deuscode',
                'ktp' => '0000000000000003',
                'email' => 'kasirdeuscode@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 2,
                'nama_input' => 'Superadmin Astana2',
            ],
            [
                'user_position' => 'superadmin_distributor',
                'id_group' => 2,
                'username' => 'sby',
                'password' => bcrypt('12345'),
                'firstname' => 'Distributor',
                'lastname' => 'Surabaya',
                'ktp' => '0000000000000004',
                'email' => 'distsby@gmail.com',
                'cluster' => 'klasterA',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 1,
                'nama_input' => 'Superadmin Astana',
            ],
            [
                'user_position' => 'accounting_distributor',
                'id_group' => 2,
                'username' => 'accountingsby',
                'password' => bcrypt('12345'),
                'firstname' => 'Accounting',
                'lastname' => 'SBY',
                'ktp' => '0000000000000005',
                'email' => 'accountingsby@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 5,
                'nama_input' => 'Distributor Surabaya',
            ],
            [
                'user_position' => 'superadmin_distributor',
                'id_group' => 3,
                'username' => 'jkt',
                'password' => bcrypt('12345'),
                'firstname' => 'Distributor',
                'lastname' => 'Jakarta',
                'ktp' => '0000000000000006',
                'email' => 'distjkt@gmail.com',
                'cluster' => 'klasterB',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 2,
                'nama_input' => 'Superadmin Astana2',
            ],
            [
                'user_position' => 'accounting_distributor',
                'id_group' => 3,
                'username' => 'accountingjkt',
                'password' => bcrypt('12345'),
                'firstname' => 'Accounting',
                'lastname' => 'JKT',
                'ktp' => '0000000000000007',
                'email' => 'accountingjkt@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 7,
                'nama_input' => 'Distributor Jakarta',
            ],
            [
                'user_position' => 'reseller',
                'id_group' => 3,
                'username' => 'resellerjkt',
                'password' => bcrypt('12345'),
                'firstname' => 'Reseller',
                'lastname' => 'JKT',
                'ktp' => '0000000000000008',
                'email' => 'resellerjkt@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 7,
                'nama_input' => 'Distributor Jakarta',
            ],
            [
                'user_position' => 'reseller',
                'id_group' => 3,
                'username' => 'resellerjkt2',
                'password' => bcrypt('12345'),
                'firstname' => 'Reseller',
                'lastname' => 'JKT2',
                'ktp' => '0000000000000009',
                'email' => 'resellerjkt2@gmail.com',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011",
                'id_input' => 7,
                'nama_input' => 'Distributor Jakarta',
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
        // FacadesSchema::enableForeignKeyConstraints();
    }
}
