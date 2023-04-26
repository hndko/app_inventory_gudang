<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunSeeder extends Seeder
{
    public function run()
    {
        $this->call('KategoriSeeder');
        $this->call('SatuanSeeder');
        $this->call('BarangSeeder');
    }
}
