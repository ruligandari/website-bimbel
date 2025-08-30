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
        $data = [
            'title' => 'Soal',
            'soals' => $dataSoal,
        ];

        return view('admin/soal/soal', $data);
    }
}
