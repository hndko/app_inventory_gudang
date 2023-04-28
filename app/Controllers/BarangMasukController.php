<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TempBarangMasukModel;

class BarangMasukController extends BaseController
{
    protected $TempBarangMasuk;
    protected $Barang;
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

        // dd($this->Barang->getSearchData(''));

        return view('dashboard/barang_masuk/index', $data);
    }

    public function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');
            $getBarang = $this->TempBarangMasuk->showDataTemp($faktur);
            if ($getBarang == null) {
                $json = [
                    'error' => 'Data Barang Tidak Ditemukan!'
                ];
            } else {
                $data = [
                    'dataTemp' => $getBarang
                ];

                $json = [
                    'success' => view('dashboard/barang_masuk/datatemp', $data)
                ];
            }

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function getDataBarang()
    {
        if ($this->request->isAJAX()) {
            $kode_barang = $this->request->getVar('kode_barang');
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

    public function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');
            $kode_barang = $this->request->getVar('kode_barang');
            $harga_beli = $this->request->getVar('harga_beli');
            $harga_jual = $this->request->getVar('harga_jual');
            $jumlah = $this->request->getVar('jumlah');

            $this->TempBarangMasuk->save([
                'det_faktur' => $faktur,
                'det_brg_kode' => $kode_barang,
                'det_harga_masuk' => $harga_beli,
                'det_harga_jual' => $harga_jual,
                'det_jumlah' => $jumlah,
                'det_subtotal' => intval($jumlah) * intval($harga_beli)
            ]);

            $json = [
                'success' => 'Item Berhasil Ditambahkan'
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->TempBarangMasuk->delete($id);

            $json = [
                'success' => 'Item Berhasil Dihapuskan'
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function searchDataBarang()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('dashboard/barang_masuk/modalcaribarang')
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function detailCariBarang()
    {
        if ($this->request->isAJAX()) {
            $cari = $this->request->getVar('cari');
            $data = $this->Barang->getSearchData($cari);

            if ($data != null) {
                $json = [
                    'data' => view('dashboard/barang_masuk/detaildatabarang', [
                        'tampildata' => $data
                    ])
                ];

                echo json_encode($json);
            } else {
                alert('Data Tidak Ditemukan');
            }
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }
}
