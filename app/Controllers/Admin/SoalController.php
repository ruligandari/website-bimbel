<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SoalController extends BaseController
{
    protected $soalModel;

    public function __construct()
    {
        $this->soalModel = model('App\Models\SoalModel');
    }

    public function index()
    {
        $dataSoal = $this->soalModel->getAllSoal();
        $kategoriModel = model('App\Models\KategoriModel');
        $dataKategori = $kategoriModel->findAll();
        $data = [
            'title' => 'Soal',
            'soals' => $dataSoal,
            'kategoris' => $dataKategori,
        ];

        return view('admin/soal/soal', $data);
    }

    public function store()
    {
        $soalModel = new \App\Models\SoalModel();

        $fileFoto = $this->request->getFile('foto');

        $namaFoto = null;

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'uploads/soal', $namaFoto);
        }

        $data = [
            'level'       => $this->request->getPost('level'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'foto'        => $namaFoto,
            'soal'        => $this->request->getPost('soal'),
            'pilihan_a'   => $this->request->getPost('pilihan_a'),
            'pilihan_b'   => $this->request->getPost('pilihan_b'),
            'pilihan_c'   => $this->request->getPost('pilihan_c'),
            'pilihan_d'   => $this->request->getPost('pilihan_d'),
            'jawaban'     => $this->request->getPost('jawaban'),
            'bobot_nilai' => $this->request->getPost('bobot_nilai'),
            'is_active'   => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $soalModel->insert($data);

        return redirect()->to(base_url('admin/soal'))->with('success', 'Soal berhasil ditambahkan.');
    }

    public function update($id)
    {
        $soalModel = new \App\Models\SoalModel();
        $data = $this->request->getPost();

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'uploads/soal', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        $soalModel->update($id, $data);

        return redirect()->to(base_url('admin/soal'))->with('success', 'Soal berhasil diupdate.');
    }


    public function delete($id)
    {
        $soalModel = new \App\Models\SoalModel();
        $soal = $soalModel->find($id);

        if ($soal) {
            // hapus file gambar kalau ada
            if (!empty($soal['foto']) && file_exists(FCPATH . 'uploads/soal/' . $soal['foto'])) {
                unlink(FCPATH . 'uploads/soal/' . $soal['foto']);
            }

            $soalModel->delete($id);
            return redirect()->to(base_url('admin/soal'))->with('success', 'Soal berhasil dihapus.');
        }

        return redirect()->to(base_url('admin/soal'))->with('error', 'Soal tidak ditemukan.');
    }
}
