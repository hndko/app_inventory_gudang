<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategoris';
    protected $primaryKey       = 'kat_id';
    protected $allowedFields    = [
        'kat_id', 'kat_nama'
    ];

    public function search($cari)
    {
        return $this->table('kategoris')->like('kat_nama', $cari);
    }
}
