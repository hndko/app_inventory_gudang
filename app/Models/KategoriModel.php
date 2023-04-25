<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategoris';
    protected $primaryKey       = 'kategori_id';
    protected $allowedFields    = [
        'kat_id', 'kat_nama'
    ];
}
