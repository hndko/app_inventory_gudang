<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SatuanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'sat_nama' => 'Pcs'
            ],
            [
                'sat_nama' => 'Box'
            ],
            [
                'sat_nama' => 'Pack'
            ],
        ];

        $this->db->table('satuans')->insertBatch($data);
    }
}
