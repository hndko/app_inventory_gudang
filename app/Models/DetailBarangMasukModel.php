<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailBarangMasukModel extends Model
{
    protected $table            = 'detail_barang_masuk';
    protected $primaryKey       = 'det_id';
    protected $allowedFields    = [
        'det_id', 'det_faktur', 'det_brg_kode', 'det_harga_masuk', 'det_harga_jual', 'det_jumlah', 'det_subtotal'
    ];
}
