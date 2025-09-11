<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama'     => 'Galuh',
            'username' => 'galuh',
            'password' => password_hash('password123', PASSWORD_BCRYPT),
        ];
        $this->db->table('siswa')->insert($data);
    }
}
