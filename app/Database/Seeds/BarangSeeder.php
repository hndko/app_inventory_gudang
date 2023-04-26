<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 15; $i++) {
            $data = [
                'brg_nama' => $faker->name(),
                'brg_kat_id' => $faker->randomElements(['1', '2', '3', '4', '5']),
                'brg_sat_id' => $faker->randomElements(['1', '2', '3']),
                'brg_harga' => $faker->randomNumber(6, true),
                'brg_stok' => $faker->numberBetween(1, 100)
            ];

            $this->db->table('barangs')->insert($data);
        }
    }
}
