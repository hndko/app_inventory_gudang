<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barangs';
    protected $primaryKey       = 'brg_id';
    protected $allowedFields    = [
        'brg_id', 'brg_kode', 'brg_nama', 'brg_kat_id', 'brg_sat_id', 'brg_harga', 'brg_gambar', 'brg_stok'
    ];

    public function getData()
    {
        return $this->table('barangs')->join('kategoris', 'brg_kat_id=kat_id')->join('satuans', 'brg_sat_id=sat_id')->findAll();
    }
}
