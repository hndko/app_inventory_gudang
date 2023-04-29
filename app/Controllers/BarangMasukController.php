<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\DetailBarangMasukModel;
use App\Models\TempBarangMasukModel;

class BarangMasukController extends BaseController
{
    protected $TempBarangMasuk;
    protected $DetailBarangMasuk;
    protected $Barang;
    protected $BarangMasuk;
    public function __construct()
    {
        $this->TempBarangMasuk = new TempBarangMasukModel();
        $this->DetailBarangMasuk = new DetailBarangMasukModel();
        $this->Barang = new BarangModel();
        $this->BarangMasuk = new BarangMasukModel();
    }

    public function index()
    {
        $tombolKeyword = $this->request->getVar('tombolKeyword');
        $data = [
            'title' => 'Barang Masuk',
            'result' => $this->BarangMasuk->findAll(),
        ];

        return view('dashboard/barang_masuk/index', $data);
    }

    public function create()
    {
        // Get Kode Barang
        $getKodeFaktur = $this->DetailBarangMasuk->selectMax('det_faktur')->first();
        $getKode = $getKodeFaktur['det_faktur'];
        $urutan = (int) substr($getKode, 4, 4);
        $urutan++;
        $huruf = 'F';
        $newKodeFaktur = $huruf . sprintf("%04s", $urutan);

        $data = [
            'title' => 'Barang Masuk',
            'kodeFaktur' => $newKodeFaktur

        ];

        return view('dashboard/barang_masuk/create', $data);
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

    public function selesaiTransaksi()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');
            $tgl_brg_masuk = $this->request->getVar('tgl_brg_masuk');

            $dataTemp = $this->TempBarangMasuk->getWhere(['det_faktur' => $faktur]);

            if ($dataTemp->getNumRows() == 0) {
                $json = [
                    'error' => 'Maaf, data item untuk faktur ini belum ada'
                ];
            } else {
                // Simpan ke Tabel Barang Masuk
                $subtotal = 0;
                foreach ($dataTemp->getResultArray() as $row) :
                    $subtotal += intval($row['det_subtotal']);
                endforeach;

                $this->BarangMasuk->save([
                    'brgm_faktur' => $faktur,
                    'brgm_tgl_faktur' => $tgl_brg_masuk,
                    'brgm_total_harga' => $subtotal
                ]);

                // Simpan Ke Table Detail Barang Masuk
                foreach ($dataTemp->getResultArray() as $row) :
                    $this->DetailBarangMasuk->save([
                        'det_faktur' => $row['det_faktur'],
                        'det_brg_kode' => $row['det_brg_kode'],
                        'det_harga_masuk' => $row['det_harga_masuk'],
                        'det_harga_jual' => $row['det_harga_jual'],
                        'det_jumlah' => $row['det_jumlah'],
                        'det_subtotal' => $row['det_subtotal']
                    ]);
                endforeach;

                // Bersihkan Data Table Temp Barang Masuk
                $this->TempBarangMasuk->truncate();

                $json = [
                    'success' => 'Transaksi Berhasil Disimpan'
                ];
            }

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function detailItem()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');

            $data = [
                'result' => $this->DetailBarangMasuk->dataDetail($faktur)
            ];

            $json = [
                'data' => view('dashboard/barang_masuk/modaldetailitem', $data)
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function edit($faktur)
    {
        $cekFaktur = $this->BarangMasuk->cekFaktur($faktur)->first();

        if ($cekFaktur != null) {
            $row = $cekFaktur;

            $data = [
                'title' => 'Barang Masuk',
                'faktur' => $row['brgm_faktur'],
                'tanggal' => $row['brgm_tgl_faktur'],
            ];

            return view('dashboard/barang_masuk/formedit', $data);
        } else {
            exit('Data Tidak Ditemukan');
        }
    }

    public function dataDetail()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');
            $getBarang = $this->DetailBarangMasuk->dataDetail($faktur);
            if ($getBarang == null) {
                $json = [
                    'error' => 'Data Barang Tidak Ditemukan!'
                ];
            } else {
                $data = [
                    'dataDetail' => $getBarang,
                ];

                $json = [
                    'success' => view('dashboard/barang_masuk/datadetail', $data),
                    'totalHarga' => "Rp " . number_format($this->DetailBarangMasuk->ambiltotalharga($faktur), 0, ',', '.')
                ];
            }

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function deleteDetail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->DetailBarangMasuk->delete($id);

            $json = [
                'success' => 'Item Berhasil Dihapuskan'
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function editItem()
    {
        if ($this->request->isAJAX()) {
            $det_id = $this->request->getVar('det_id');

            $ambilBarang = $this->DetailBarangMasuk->dataBarangByID($det_id);
            $data = [
                'brg_kode' => $ambilBarang['det_brg_kode'],
                'brg_nama' => $ambilBarang['brg_nama'],
                'brg_harga_jual' => $ambilBarang['det_harga_jual'],
                'brg_harga_masuk' => $ambilBarang['det_harga_masuk'],
                'brg_jumlah' => $ambilBarang['det_jumlah'],
            ];

            $json = [
                'success' => $data
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }

    public function simpanDetail()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getVar('faktur');
            $kode_barang = $this->request->getVar('kode_barang');
            $harga_beli = $this->request->getVar('harga_beli');
            $harga_jual = $this->request->getVar('harga_jual');
            $jumlah = $this->request->getVar('jumlah');

            $this->DetailBarangMasuk->save([
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

    public function editDetailItem()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $faktur = $this->request->getVar('faktur');
            $kode_barang = $this->request->getVar('kode_barang');
            $harga_beli = $this->request->getVar('harga_beli');
            $harga_jual = $this->request->getVar('harga_jual');
            $jumlah = $this->request->getVar('jumlah');

            $this->DetailBarangMasuk->save([
                'det_id' => $id,
                'det_faktur' => $faktur,
                'det_brg_kode' => $kode_barang,
                'det_harga_masuk' => $harga_beli,
                'det_harga_jual' => $harga_jual,
                'det_jumlah' => $jumlah,
                'det_subtotal' => intval($jumlah) * intval($harga_beli)
            ]);

            $json = [
                'success' => 'Item Berhasil Diperbaharui'
            ];

            echo json_encode($json);
        } else {
            exit('Maaf tidak bisa dipanggil');
        }
    }
}
