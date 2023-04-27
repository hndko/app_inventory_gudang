<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SatuanModel;

class BarangController extends BaseController
{
    public function __construct()
    {
        $this->barang = new BarangModel();
        $this->kategori = new KategoriModel();
        $this->satuan = new SatuanModel();
    }

    public function index()
    {
        $no = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : '1';
        $data = [
            'title' => 'Barang',
            // 'tampilData' => $this->barang->paginate(5, 'barang'),
            'tampilData' => $this->barang->getData(),
            'no' => 1 + (($no - 1) * 5),
        ];

        return view('dashboard/barang/index', $data);
    }

    public function create()
    {
        // Get Kode Barang
        $getKodeBarang = $this->barang->selectMax('brg_kode')->first();
        $getKode = $getKodeBarang['brg_kode'];
        $urutan = (int) substr($getKode, 4, 4);
        $urutan++;
        $huruf = 'BRG';
        $newKodeBarang = $huruf . sprintf("%04s", $urutan);

        $data = [
            'title' => 'Barang',
            'pages' => 'Tambah Data',
            'dataKategori' => $this->kategori->findAll(),
            'dataSatuan' => $this->satuan->findAll(),
            'kodeBarang' => $newKodeBarang
        ];

        return view('dashboard/barang/create', $data);
    }

    public function store()
    {
        $rules = [
            'brg_kode' => [
                'rules' => 'required',
                'label' => 'Kode barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_nama' => [
                'rules' => 'required|min_length[3]',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_kat_id' => [
                'rules' => 'required',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_sat_id' => [
                'rules' => 'required',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_harga' => [
                'rules' => 'required|numeric',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'brg_stok' => [
                'rules' => 'required|numeric',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'brg_gambar' => [
                'rules' => 'mime_in[brg_gambar,image/png,image/jpeg, image/jpg]|ext_in[brg_gambar,png,jpg,jpeg]',
                'label' => 'Gambar'
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $brg_gambar = $this->request->getFile('brg_gambar');
        if ($brg_gambar->getError() == 4) {
            $newGambar = null;
        } else {
            $newGambar = $brg_gambar->getRandomName();
            $brg_gambar->move('assets/upload', $newGambar);
        }

        $this->barang->save([
            'brg_kode' => $this->request->getVar('brg_kode'),
            'brg_nama' => $this->request->getVar('brg_nama'),
            'brg_kat_id' => $this->request->getVar('brg_kat_id'),
            'brg_sat_id' => $this->request->getVar('brg_sat_id'),
            'brg_harga' => $this->request->getVar('brg_harga'),
            'brg_stok' => $this->request->getVar('brg_stok'),
            'brg_gambar' => $newGambar,
        ]);

        session()->setFlashdata('success', 'Data Berhasil Ditambahkan.');
        return redirect()->to('barang');
    }

    public function edit($id)
    {
        $cekData = $this->barang->find($id);

        if ($cekData) {
            $data = [
                'title' => 'Barang',
                'pages' => 'Edit Data Barang',
                'row' => $cekData,
                'dataKategori' => $this->kategori->findAll(),
                'dataSatuan' => $this->satuan->findAll(),
            ];

            return view('dashboard/barang/edit', $data);
        } else {
            session()->setFlashdata('error', 'Data Tidak Ditemukan.');
            return redirect()->to('barang');
        }
    }

    public function update()
    {
        $rules = [
            'brg_kode' => [
                'rules' => 'required',
                'label' => 'Kode barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_nama' => [
                'rules' => 'required|min_length[3]',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_kat_id' => [
                'rules' => 'required',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_sat_id' => [
                'rules' => 'required',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'brg_harga' => [
                'rules' => 'required|numeric',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'brg_stok' => [
                'rules' => 'required|numeric',
                'label' => 'Nama barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $brg_gambar = $this->request->getFile('brg_gambar');
        if ($brg_gambar->getError() == 4) {
            $newGambar = $this->request->getVar('brg_gambar_old');
        } else {
            $result = $this->barang->where('brg_id', $this->request->getVar('brg_id'))->first();
            if ($result['brg_gambar'] == null) {
                $newGambar = $brg_gambar->getRandomName();
                $brg_gambar->move('assets/upload', $newGambar);
            } else {
                $newGambar = $brg_gambar->getRandomName();
                $brg_gambar->move('assets/upload', $newGambar);

                $unlink = $this->request->getVar('brg_gambar_old');
                unlink('assets/upload/' . $unlink);
            }
        }

        $this->barang->save([
            'brg_id' => $this->request->getVar('brg_id'),
            'brg_kode' => $this->request->getVar('brg_kode'),
            'brg_nama' => $this->request->getVar('brg_nama'),
            'brg_kat_id' => $this->request->getVar('brg_kat_id'),
            'brg_sat_id' => $this->request->getVar('brg_sat_id'),
            'brg_harga' => $this->request->getVar('brg_harga'),
            'brg_stok' => $this->request->getVar('brg_stok'),
            'brg_gambar' => $newGambar,
        ]);

        session()->setFlashdata('success', 'Data Berhasil Diubahkan.');
        return redirect()->to('barang');
    }

    public function delete($id)
    {
        $result = $this->barang->where('brg_id', $id)->first();
        if ($result['brg_gambar'] == null) {
            $this->barang->delete($id);
            session()->setFlashdata('success', 'Data Berhasil Dihapuskan.');
            return redirect()->to('barang');
        } else {
            $unlink = $result['brg_gambar'];
            unlink('assets/upload/' . $unlink);

            $this->barang->delete($id);
            session()->setFlashdata('success', 'Data Berhasil Dihapuskan.');
            return redirect()->to('barang');
        }
    }
}
