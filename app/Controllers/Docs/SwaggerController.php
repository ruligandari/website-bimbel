<?php

namespace App\Controllers\Docs;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SwaggerController extends BaseController
{
    public function index()
    {
        return view('docs/swagger');
    }
}
