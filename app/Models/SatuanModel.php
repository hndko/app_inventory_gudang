<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table            = 'satuans';
    protected $primaryKey       = 'sat_id';
    protected $allowedFields    = [
        'sat_id', 'sat_nama'
    ];

    public function search($cari)
    {
        return $this->table('satuans')->like('sat_nama', $cari);
    }
}
