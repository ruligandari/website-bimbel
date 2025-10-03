<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use OpenApi\Attributes as OA;

class ApiController extends BaseController
{
    // constructor
    public function __construct()
    {
        helper('api_helper');
    }

    #[OA\Get(
        path: "/api/soal",
        summary: "Ambil list soal atau detail berdasarkan filter",
        tags: ["Soal"],
        parameters: [
            new OA\Parameter(
                name: "kategori",
                in: "query",
                required: false,
                description: "Filter soal berdasarkan nama kategori (numerik, color, greeting, family)",
                schema: new OA\Schema(type: "string")
            ),
            new OA\Parameter(
                name: "nomor",
                in: "query",
                required: false,
                description: "Ambil soal berdasarkan ID (nomor soal)",
                schema: new OA\Schema(type: "integer", format: "int64")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Berhasil ambil daftar soal",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 12),
                            new OA\Property(property: "soal", type: "string", example: "Apa ibu kota Indonesia?"),
                            new OA\Property(property: "kategori", type: "string", example: "IPS"),
                            new OA\Property(property: "pilihan_a", type: "string", example: "Jakarta"),
                            new OA\Property(property: "pilihan_b", type: "string", example: "Bandung"),
                            new OA\Property(property: "pilihan_c", type: "string", example: "Surabaya"),
                            new OA\Property(property: "pilihan_d", type: "string", example: "Medan"),
                            new OA\Property(property: "jawaban", type: "string", example: "A"),
                            new OA\Property(property: "bobot_nilai", type: "integer", example: 10)
                        ]
                    )
                )
            ),
            new OA\Response(
                response: 206,
                description: "Berhasil ambil detail soal tunggal (jika pakai ?nomor=)",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 12),
                        new OA\Property(property: "soal", type: "string", example: "Apa ibu kota Indonesia?"),
                        new OA\Property(property: "kategori", type: "string", example: "IPS"),
                        new OA\Property(property: "pilihan_a", type: "string", example: "Jakarta"),
                        new OA\Property(property: "pilihan_b", type: "string", example: "Bandung"),
                        new OA\Property(property: "pilihan_c", type: "string", example: "Surabaya"),
                        new OA\Property(property: "pilihan_d", type: "string", example: "Medan"),
                        new OA\Property(property: "jawaban", type: "string", example: "A"),
                        new OA\Property(property: "bobot_nilai", type: "integer", example: 10)
                    ]
                )
            )
        ]
    )]
    public function getSoal()
    {
        $soalModel = model('App\Models\SoalModel');
        $kategori  = $this->request->getGet('kategori');
        $nomor     = $this->request->getGet('nomor');

        if ($kategori === 'family') {
            // Ambil 5 soal untuk setiap kategori
            $soalNumerik = $soalModel->join('kategori', 'kategori.id = soal.kategori_id')
                ->select('soal.*, kategori.kode as kategori_soal')
                ->where('kategori.kode', 'numerik')
                ->orderBy('RAND()') // acak
                ->limit(5)
                ->findAll();

            $soalGreeting = $soalModel->join('kategori', 'kategori.id = soal.kategori_id')
                ->select('soal.*, kategori.kode as kategori_soal')
                ->where('kategori.kode', 'greeting')
                ->orderBy('RAND()')
                ->limit(5)
                ->findAll();

            $soalColor = $soalModel->join('kategori', 'kategori.id = soal.kategori_id')
                ->select('soal.*, kategori.kode as kategori_soal')
                ->where('kategori.kode', 'color')
                ->orderBy('RAND()')
                ->limit(5)
                ->findAll();

            $soalFamily = $soalModel->join('kategori', 'kategori.id = soal.kategori_id')
                ->select('soal.*, kategori.kode as kategori_soal')
                ->where('kategori.kode', 'family')
                ->orderBy('RAND()')
                ->limit(5)
                ->findAll();

            $soal = array_merge($soalFamily, $soalNumerik, $soalGreeting, $soalColor);
            $statusCode = 200;
        } elseif ($kategori) {
            $soal = $soalModel->join('kategori', 'kategori.id = soal.kategori_id')
                ->select('soal.*, kategori.kode as kategori_soal')
                ->where('kategori.kode', $kategori)
                ->findAll();
            $statusCode = 200;
        } elseif ($nomor) {
            $soal = $soalModel->where('id', $nomor)->first();
            $statusCode = 206; // Partial Content
        } else {
            $soal = $soalModel->findAll();
            $statusCode = 200;
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $soal
        ])->setStatusCode($statusCode);
    }

    #[OA\Post(
        path: '/api/login',
        summary: 'Login Siswa',
        tags: ['Login Siswa'],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'username', type: 'string'),
                    new OA\Property(property: 'password', type: 'string'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Login berhasil',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(property: 'data', type: 'object', additionalProperties: false)
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Bad Request',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'error'),
                        new OA\Property(property: 'message', type: 'string', example: 'Username and password are required')
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthorized',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'error'),
                        new OA\Property(property: 'message', type: 'string', example: 'Invalid username or password')
                    ]
                )
            )
        ]
    )]
    public function loginSiswa()
    {
        $data = $this->request->getJSON(true);
        // tangkap username dan password
        $username = $data['username'];
        $password = $data['password'];

        // logic login siswa

        if (!$username || !$password) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['status' => 'error', 'message' => 'Username and password are required']);
        } else {
            // validasi user
            $siswaModel = model('App\Models\SiswaModel');
            $siswa = $siswaModel->where('username', $username)->first();
            if (!$siswa || !password_verify($password, $siswa['password'])) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                    ->setJSON(['status' => 'error', 'message' => 'Invalid username or password']);
            }
            // kembalikan data siswa tanpa password
            unset($siswa['password']);
            return $this->response->setJSON(['status' => 'success', 'data' => $siswa]);
        }
    }
}
