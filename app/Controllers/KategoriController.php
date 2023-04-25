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
        $data = [
            'title' => 'Kategori',
            'tampilData' => $this->kategori->findAll()
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
}
