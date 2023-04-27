<?php

namespace App\Models;

use CodeIgniter\Model;

class TempBarangMasukModel extends Model
{
    protected $table            = 'temp_barang_masuk';
    protected $primaryKey       = 'det_id';
    protected $allowedFields    = [
        'det_id', 'det_faktur', 'det_brg_kode', 'det_harga_masuk', 'det_harga_jual', 'det_jumlah', 'det_subtotal'
    ];

    public function showDataTemp($faktur)
    {
        return $this->table('temp_barang_masuk')->join('barangs', 'brg_kode=det_brg_kode')->where('det_faktur', $faktur)->get();
    }
}
