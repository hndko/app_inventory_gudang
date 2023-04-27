<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'brgm_id';
    protected $allowedFields    = [
        'brgm_id', 'brgm_faktur', 'brgm_tgl_faktur', 'brgm_total_harga'
    ];
}
