<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('kategori')->insertBatch([
            ['kode' => 'numerik',  'nama' => 'Numerik'],
            ['kode' => 'color',    'nama' => 'Color'],
            ['kode' => 'greeting', 'nama' => 'Greeting'],
            ['kode' => 'family',   'nama' => 'Family'],
        ]);
    }
}
