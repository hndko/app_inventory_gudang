<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TempBarangMasukModel;

class BarangMasukController extends BaseController
{
    public function __construct()
    {
        $this->TempBarangMasuk = new TempBarangMasukModel();
        $this->Barang = new BarangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang Masuk',
        ];

        return view('dashboard/barang_masuk/index', $data);
    }

    public function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');

            $data = [
                'dataTemp' => $this->TempBarangMasuk->showDataTemp($faktur)
            ];

            $json = [
                'data' => view('dashboard/barang_masuk/datatemp', $data)
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function getDataBarang()
    {
        if ($this->request->isAJAX()) {
            $kode_barang = $this->request->getPost('kode_barang');
            $dataBarang = $this->Barang->where('brg_kode', $kode_barang)->first();
            if ($dataBarang == null) {
                $json = [
                    'error' => 'Data Barang Tidak Ditemukan!'
                ];
            } else {
                $data = [
                    'brg_nama' => $dataBarang['brg_nama'],
                    'brg_harga' => $dataBarang['brg_harga'],
                ];

                $json = [
                    'data' => $data
                ];
            }

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }
}
