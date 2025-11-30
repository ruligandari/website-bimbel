<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class GuruController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        // Get all guru (role = 2)
        $data = [
            'title' => 'Manage Guru',
            'gurus' => $this->user->where('role', 2)->findAll(),
        ];

        return view('admin/guru/index', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'username' => 'required|is_unique[user.username]',
            'password' => 'required|min_length[6]',
            'cabang' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->user->insert([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => 2, // Guru
            'cabang' => $this->request->getPost('cabang'),
        ]);

        return redirect()->to(base_url('admin/guru'))->with('success', 'Guru berhasil ditambahkan');
    }

    public function update($id)
    {
        $guru = $this->user->find($id);
        if (!$guru || $guru['role'] != 2) {
            return redirect()->to(base_url('admin/guru'))->with('error', 'Guru tidak ditemukan');
        }

        $rules = [
            'nama' => 'required',
            'username' => 'required|is_unique[user.username,id,' . $id . ']',
            'cabang' => 'required',
        ];

        // If password is filled, validate it
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'cabang' => $this->request->getPost('cabang'),
        ];

        // If password is filled, hash it
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $this->user->update($id, $data);

        return redirect()->to(base_url('admin/guru'))->with('success', 'Guru berhasil diupdate');
    }

    public function delete($id)
    {
        $guru = $this->user->find($id);
        if (!$guru || $guru['role'] != 2) {
            return redirect()->to(base_url('admin/guru'))->with('error', 'Guru tidak ditemukan');
        }

        $this->user->delete($id);
        return redirect()->to(base_url('admin/guru'))->with('success', 'Guru berhasil dihapus');
    }
}
