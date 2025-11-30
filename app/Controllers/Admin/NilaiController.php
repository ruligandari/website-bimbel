<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiController extends BaseController
{
    public function index()
    {
        $nilaiModel = new \App\Models\NilaiModel();
        
        // Get user role from session
        $role = session()->get('role');
        $userId = session()->get('user_id');
        
        // join siswa
        $nilaiModel->select('nilai.*, siswa.nama, siswa.username');
        $nilaiModel->join('siswa', 'siswa.id = nilai.siswa_id', 'left');
        
        // If guru (role = 2), only show grades from students added by this guru
        if ($role == 2) {
            $nilaiModel->where('siswa.guru_id', $userId);
        }
        // Admin (role = 1) can see all grades - no additional where clause needed
        
        $data = [
            'nilais' => $nilaiModel->orderBy('nilai.id', 'DESC')->findAll(),
            'title' => 'Data Nilai Siswa',
        ];

        return view('admin/nilai/nilai', $data);
    }
}
