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

    public function delete($id)
    {
        // Only admin can delete nilai
        $role = session()->get('role');
        if ($role != 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus data nilai'
            ])->setStatusCode(403);
        }

        $nilaiModel = new \App\Models\NilaiModel();
        
        // Check if nilai exists
        $nilai = $nilaiModel->find($id);
        if (!$nilai) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data nilai tidak ditemukan'
            ])->setStatusCode(404);
        }

        // Delete the nilai
        if ($nilaiModel->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data nilai berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus data nilai'
            ])->setStatusCode(500);
        }
    }
}
