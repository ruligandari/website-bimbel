<?php

namespace App\Docs;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "API Soal",
    description: "Dokumentasi API Soal & Nilai"
)]
#[OA\Server(
    url: "http://localhost:8080/",
    description: "Local Server"
)]
class OpenApiSpec {}
