<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kat_nama' => 'HDD'
            ],
            [
                'kat_nama' => 'SSD'
            ],
            [
                'kat_nama' => 'TAS'
            ],
        ];

        $this->db->table('kategoris')->insertBatch($data);
    }
}
