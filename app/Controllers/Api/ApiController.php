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
        $kategori = $this->request->getGet('kategori');
        $nomor    = $this->request->getGet('nomor');

        if ($kategori) {
            $soal = $soalModel->join('kategori', 'kategori.id = soal.kategori_id')
                ->select('soal.*, kategori.kode as kategori_soal')
                ->where('kategori.kode', $kategori)
                ->findAll();
            $statusCode = 200;
        } elseif ($nomor) {
            $soal = $soalModel->where('id', $nomor)->first();
            $statusCode = 206; // Partial Content → menandakan hanya 1 item
        } else {
            $soal = $soalModel->findAll();
            $statusCode = 200;
        }

        return $this->response->setStatusCode($statusCode)
            ->setJSON(apiResponse($soal));
    }

    public function postNilai()
    {
        $data = $this->request->getPost();
        // Proses data nilai
        return $this->response->setJSON(['status' => 'success']);
    }
}
