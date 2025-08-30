<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = model('App\Models\UserModel');
    }
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('admin/auth/login', $data);
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->user->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);

            return redirect()->to('/admin/dashboard');
        } else {
            session()->setFlashdata('error', 'username atau password salah');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
