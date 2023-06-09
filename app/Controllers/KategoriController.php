<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $searchKategori = $this->kategori->search($keyword);
        } else {
            $searchKategori = $this->kategori;
        }

        $no = $this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : '1';
        $data = [
            'title' => 'Kategori',
            // 'tampilData' => $this->kategori->paginate(5, 'kategori'),
            'tampilData' => $searchKategori->paginate(5, 'kategori'),
            'pager' => $this->kategori->pager,
            'no' => 1 + (($no - 1) * 5),
        ];

        return view('dashboard/kategori/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Kategori',
            'pages' => 'Tambah Data'
        ];

        return view('dashboard/kategori/create', $data);
    }

    public function store()
    {
        $rules = [
            'kat_nama' => [
                'rules' => 'required|min_length[3]',
                'label' => 'Nama kategori',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->kategori->save([
            'kat_nama' => $this->request->getVar('kat_nama'),
        ]);

        session()->setFlashdata('success', 'Data Berhasil Ditambahkan.');
        return redirect()->to('kategori');
    }

    public function edit($id)
    {
        $cekData = $this->kategori->find($id);

        if ($cekData) {
            $data = [
                'title' => 'Kategori',
                'pages' => 'Edit Data Kategori',
                'row' => $cekData
            ];

            return view('dashboard/kategori/edit', $data);
        } else {
            session()->setFlashdata('error', 'Data Tidak Ditemukan.');
            return redirect()->to('kategori');
        }
    }

    public function update()
    {
        $rules = [
            'kat_nama' => [
                'rules' => 'required|min_length[3]',
                'label' => 'Nama kategori',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->kategori->save([
            'kat_id' => $this->request->getVar('kat_id'),
            'kat_nama' => $this->request->getVar('kat_nama'),
        ]);

        session()->setFlashdata('success', 'Data Berhasil Diubahkan.');
        return redirect()->to('kategori');
    }

    public function delete($id)
    {
        $this->kategori->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Dihapuskan.');
        return redirect()->to('kategori');
    }
}
