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
                // 'user_type' => 'pabrik',
                'user_position' => 'superadmin_pabrik',
                'id_group' => 'deuscode',
                'username' => 'deuscode',
                'password' => bcrypt('12345'),
                'firstname' => 'Deus',
                'lastname' => 'Code',
                'ktp' => '0000000000000000',
                'email' => 'deuscode@gmail.com',
                'id_input' => 1,
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
            [
                // 'user_type' => 'pabrik',
                'user_position' => 'superadmin_pabrik',
                'id_group' => 'deuscode',
                'username' => 'deuscode2',
                'password' => bcrypt('12345'),
                'firstname' => 'Deus',
                'lastname' => 'Code2',
                'ktp' => '0000000000000001',
                'email' => 'deuscode2@gmail.com',
                'id_input' => 1,
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
            [
                // 'user_type' => 'pabrik',
                'user_position' => 'accounting_pabrik',
                'id_group' => 'deuscode',
                'username' => 'accountingdeuscode',
                'password' => bcrypt('12345'),
                'firstname' => 'Accounting',
                'lastname' => 'Deuscode',
                'ktp' => '0000000000000002',
                'email' => 'accountingdeuscode@gmail.com',
                'id_input' => 1,
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
            [
                // 'user_type' => 'pabrik',
                'user_position' => 'cashier_pabrik',
                'id_group' => 'deuscode',
                'username' => 'kasirdeuscode',
                'password' => bcrypt('12345'),
                'firstname' => 'Kasir',
                'lastname' => 'Deuscode',
                'ktp' => '0000000000000003',
                'email' => 'kasirdeuscode@gmail.com',
                'id_input' => 2,
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
            [
                // 'user_type' => 'distributor',
                'user_position' => 'superadmin_distributor',
                'id_group' => 'kz',
                'username' => 'kz',
                'password' => bcrypt('12345'),
                'firstname' => 'Kezia',
                'lastname' => 'Angeline',
                'ktp' => '0000000000000004',
                'email' => 'kezia@gmail.com',
                'id_input' => 1,
                'cluster' => 'klasterA',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
            [
                // 'user_type' => 'distributor',
                'user_position' => 'accounting_distributor',
                'id_group' => 'kz',
                'username' => 'accountingkz',
                'password' => bcrypt('12345'),
                'firstname' => 'Accounting',
                'lastname' => 'KZ',
                'ktp' => '0000000000000005',
                'email' => 'accountingkezia@gmail.com',
                'id_input' => 5,
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
            [
                // 'user_type' => 'distributor',
                'user_position' => 'superadmin_distributor',
                'id_group' => 'ang',
                'username' => 'ang',
                'password' => bcrypt('12345'),
                'firstname' => 'Angel',
                'lastname' => 'Angeline',
                'ktp' => '0000000000000006',
                'email' => 'angel@gmail.com',
                'id_input' => 2,
                'cluster' => 'klasterB',
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
            [
                // 'user_type' => 'distributor',
                'user_position' => 'accounting_distributor',
                'id_group' => 'ang',
                'username' => 'accountingang',
                'password' => bcrypt('12345'),
                'firstname' => 'Accounting',
                'lastname' => 'Ang',
                'ktp' => '0000000000000007',
                'email' => 'accountingangel@gmail.com',
                'id_input' => 7,
                'province_id' => 11,
                'city_id' => 1101,
                'address' => "jalan ACEH KABUPATEN SIMEULUE",
                'postcode' => "11011"
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
        // FacadesSchema::enableForeignKeyConstraints();
    }
}
