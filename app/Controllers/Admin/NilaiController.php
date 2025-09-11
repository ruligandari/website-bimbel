<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiController extends BaseController
{
    public function index()
    {
        $nilaiModel = new \App\Models\NilaiModel();
        // join siswa
        $nilaiModel->select('nilai.*, siswa.nama, siswa.username');
        $nilaiModel->join('siswa', 'siswa.id = nilai.siswa_id', 'left');
        $data = [
            'nilais' => $nilaiModel->orderBy('nilai.id', 'DESC')->findAll(),
            'title' => 'Data Nilai Siswa',
        ];

        return view('admin/nilai/nilai', $data);
    }
}
