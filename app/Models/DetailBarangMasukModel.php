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

    public function dataDetail($faktur)
    {
        return $this->table('detail_barang_masuk')->join('barangs', 'barangs.brg_kode = detail_barang_masuk.det_brg_kode')->where('det_faktur', $faktur)->findAll();
    }

    public function ambiltotalharga($faktur)
    {
        $query = $this->where('det_faktur', $faktur)->findAll();

        $totalHarga = 0;
        foreach ($query as $row) {
            $totalHarga += $row['det_subtotal'];
        }

        return $totalHarga;
    }

    public function dataBarangByID($id)
    {
        return $this->table('detail_barang_masuk')->join('barangs', 'barangs.brg_kode = detail_barang_masuk.det_brg_kode')->where('det_id', $id)->first();
    }
}
