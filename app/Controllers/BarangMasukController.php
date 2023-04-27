<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TempBarangMasukModel;

class BarangMasukController extends BaseController
{
    public function __construct()
    {
        $this->TempBarangMasuk = new TempBarangMasukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang Masuk'
        ];

        return view('dashboard/barang_masuk/index', $data);
    }

    public function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');

            $data = [
                'dataTemp' => $this->TempBarangMasukModel->showDataTemp($faktur)
            ];

            $json = [
                'data' => view('barang_masuk/datatemp', $data)
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }
}
