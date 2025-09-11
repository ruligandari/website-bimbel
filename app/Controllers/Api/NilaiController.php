<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NilaiModel;
use OpenApi\Attributes as OA;

class NilaiController extends BaseController
{

    #[
        OA\Post(
            path: '/api/nilai/start',
            summary: 'Mulai attempt baru untuk siswa',
            tags: ['Nilai'],
        ),
        OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['siswa_id'],
                properties: [
                    new OA\Property(property: 'siswa_id', type: 'integer', example: 1, description: 'ID siswa yang memulai attempt')
                ]
            )
        ),
        OA\Response(
            response: 200,
            description: 'Berhasil memulai attempt baru',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'status', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Percobaan baru dimulai'),
                    new OA\Property(property: 'attempt', type: 'integer', example: 2)
                ]
            )
        )
    ]
    public function start()
    {
        $siswaId = $this->request->getJSON(true)['siswa_id'];
        if (!$siswaId) {
            return $this->response->setJSON(['status' => false, 'message' => 'siswa_id harus diisi'])
                ->setStatusCode(400);
        }

        $nilaiModel = new NilaiModel();

        // cari attempt terakhir
        $last = $nilaiModel->where('siswa_id', $siswaId)->orderBy('attempt', 'DESC')->first();
        $nextAttempt = $last ? $last['attempt'] + 1 : 1;

        $nilaiModel->insert([
            'siswa_id' => $siswaId,
            'attempt'  => $nextAttempt,
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Percobaan baru dimulai',
            'attempt' => $nextAttempt
        ]);
    }

    #[OA\Post(
        path: "/api/nilai/update",
        summary: "Update nilai attempt",
        tags: ["Nilai"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["siswa_id", "attempt"],
                properties: [
                    new OA\Property(property: "siswa_id", type: "integer", example: 1),
                    new OA\Property(property: "attempt", type: "integer", example: 1),
                    new OA\Property(property: "nilai_numerik", type: "integer", example: 80),
                    new OA\Property(property: "nilai_color", type: "integer", example: 90),
                    new OA\Property(property: "nilai_greeting", type: "integer", example: 70),
                    new OA\Property(property: "nilai_family", type: "integer", example: 85),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Nilai berhasil diupdate"
            )
        ]
    )]
    public function update()
    {
        // get data json
        $data = $this->request->getJSON(true);
        if (!isset($data['siswa_id']) || !isset($data['attempt'])) {
            return $this->response->setJSON(['status' => false, 'message' => 'siswa_id dan attempt harus diisi'])
                ->setStatusCode(400);
        }
        $siswaId = $data['siswa_id'];
        $attempt = $data['attempt'];

        $nilaiModel = new NilaiModel();

        // ambil record attempt aktif
        $nilai = $nilaiModel->where([
            'siswa_id' => $siswaId,
            'attempt'  => $attempt
        ])->first();

        if (!$nilai) {
            return $this->response->setJSON(['status' => false, 'message' => 'Attempt tidak ditemukan'])
                ->setStatusCode(404);
        }

        // update kolom sesuai yang dikirim
        $updateData = [];
        foreach (['nilai_numerik', 'nilai_color', 'nilai_greeting', 'nilai_family'] as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        // hitung total jika semua sudah ada
        if (
            isset($updateData['nilai_numerik']) || isset($updateData['nilai_color']) ||
            isset($updateData['nilai_greeting']) || isset($updateData['nilai_family'])
        ) {
            $merged = array_merge($nilai, $updateData);
            if (
                $merged['nilai_numerik'] !== null && $merged['nilai_color'] !== null &&
                $merged['nilai_greeting'] !== null && $merged['nilai_family'] !== null
            ) {
                $updateData['total_nilai'] =
                    $merged['nilai_numerik'] +
                    $merged['nilai_color'] +
                    $merged['nilai_greeting'] +
                    $merged['nilai_family'];
            }
        }

        $nilaiModel->update($nilai['id'], $updateData);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Nilai berhasil diupdate',
            'data' => $updateData
        ]);
    }

    #[
        OA\Get(
            path: '/api/nilai',
            summary: 'Get Nilai Siswa',
            tags: ['Nilai'],
            parameters: [
                new OA\Parameter(
                    name: 'siswa_id',
                    in: 'query',
                    required: false,
                    description: 'Filter nilai berdasarkan ID siswa, jika tidak diberikan maka tampilkan semua',
                    schema: new OA\Schema(type: 'integer')
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Berhasil mengambil data nilai',
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(property: 'status', type: 'boolean', example: true),
                            new OA\Property(property: 'data', type: 'array', items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer', example: 1),
                                    new OA\Property(property: 'siswa_id', type: 'integer', example: 1),
                                    new OA\Property(property: 'attempt', type: 'integer', example: 1),
                                    new OA\Property(property: 'nilai_numerik', type: 'number', example: 80),
                                    new OA\Property(property: 'nilai_color', type: 'number', example: 80),
                                    new OA\Property(property: 'nilai_greeting', type: 'number', example: 80),
                                    new OA\Property(property: 'nilai_family', type: 'number', example: 80)
                                ]
                            ))
                        ]
                    )
                )
            ]
        )
    ]
    public function getNilai()
    {
        $id_siswa = $this->request->getGet('siswa_id');
        $nilaiModel = new NilaiModel();
        if (!$id_siswa) {
            // tampilkan semua
            $data = $nilaiModel->findAll();
        } else {
            $data = $nilaiModel->where('siswa_id', $id_siswa)->findAll();
        }
        return $this->response->setJSON(['status' => true, 'data' => $data]);
    }
}
