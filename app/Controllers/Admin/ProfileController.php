<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = model('App\Models\UserModel');
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $user = $this->user->find($userId);

        if (!$user) {
            return redirect()->to('/')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'title' => 'Profile',
            'user' => $user,
        ];

        return view('admin/profile/index', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $user = $this->user->find($userId);

        if (!$user) {
            return redirect()->to('/')->with('error', 'User tidak ditemukan');
        }

        $rules = [
            'nama' => 'required',
            'username' => 'required|is_unique[user.username,id,' . $userId . ']',
        ];

        // If guru, cabang is required
        if (session()->get('role') == 2) {
            $rules['cabang'] = 'required';
        }

        // If password is filled, validate it
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
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

        $this->user->update($userId, $data);

        // Update session data
        session()->set('nama', $data['nama']);
        session()->set('username', $data['username']);
        session()->set('cabang', $data['cabang']);

        return redirect()->to(base_url('admin/profile'))->with('success', 'Profile berhasil diupdate');
    }
}
