<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SiswaModel;

class SiswaController extends BaseController
{
    public function index()
    {
        $model = new SiswaModel();
        $data = [
            'siswas' => $model->orderBy('id', 'DESC')->findAll(),
            'title' => 'Data Siswa',
        ];
        return view('admin/siswa/siswa', $data);
    }

    public function store()
    {
        $rules = [
            'nama'     => 'required',
            'username' => 'required|is_unique[siswa.username]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new SiswaModel();
        $model->insert([
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ]);

        return redirect()->to(base_url('admin/siswa'))->with('success', 'Siswa berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);
        if (!$siswa) {
            return redirect()->to(base_url('admin/siswa'))->with('error', 'Siswa tidak ditemukan');
        }

        $rules = [
            'nama'     => 'required',
            'username' => 'required|is_unique[siswa.username,id,' . $id . ']',
        ];

        // jika password diisi, maka validasi password
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
        ];

        // jika password diisi, maka hash password
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $model->update($id, $data);

        return redirect()->to(base_url('admin/siswa'))->with('success', 'Siswa berhasil diupdate');
    }
    public function delete($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);
        if (!$siswa) {
            return redirect()->to(base_url('admin/siswa'))->with('error', 'Siswa tidak ditemukan');
        }

        $model->delete($id);
        return redirect()->to(base_url('admin/siswa'))->with('success', 'Siswa berhasil dihapus');
    }
}
