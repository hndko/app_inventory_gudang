<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SatuanModel;

class SatuanController extends BaseController
{
    public function __construct()
    {
        $this->satuan = new SatuanModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $searchSatuan = $this->satuan->search($keyword);
        } else {
            $searchSatuan = $this->satuan;
        }

        $no = $this->request->getVar('page_satuan') ? $this->request->getVar('page_satuan') : '1';
        $data = [
            'title' => 'Satuan',
            // 'tampilData' => $this->satuan->paginate(5, 'satuan'),
            'tampilData' => $searchSatuan->paginate(5, 'satuan'),
            'pager' => $this->satuan->pager,
            'no' => 1 + (($no - 1) * 5),
        ];

        return view('dashboard/satuan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Satuan',
            'pages' => 'Tambah Data'
        ];

        return view('dashboard/satuan/create', $data);
    }

    public function store()
    {
        $rules = [
            'sat_nama' => [
                'rules' => 'required|min_length[3]',
                'label' => 'Nama satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->satuan->save([
            'sat_nama' => $this->request->getVar('sat_nama'),
        ]);

        session()->setFlashdata('success', 'Data Berhasil Ditambahkan.');
        return redirect()->to('satuan');
    }

    public function edit($id)
    {
        $cekData = $this->satuan->find($id);

        if ($cekData) {
            $data = [
                'title' => 'Satuan',
                'pages' => 'Edit Data Satuan',
                'row' => $cekData
            ];

            return view('dashboard/satuan/edit', $data);
        } else {
            session()->setFlashdata('error', 'Data Tidak Ditemukan.');
            return redirect()->to('satuan');
        }
    }

    public function update()
    {
        $rules = [
            'sat_nama' => [
                'rules' => 'required|min_length[3]',
                'label' => 'Nama satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->satuan->save([
            'sat_id' => $this->request->getVar('sat_id'),
            'sat_nama' => $this->request->getVar('sat_nama'),
        ]);

        session()->setFlashdata('success', 'Data Berhasil Diubahkan.');
        return redirect()->to('satuan');
    }

    public function delete($id)
    {
        $this->satuan->delete($id);
        session()->setFlashdata('success', 'Data Berhasil Dihapuskan.');
        return redirect()->to('satuan');
    }
}
