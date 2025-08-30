<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Insert a sample user into the user table
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ];

        $this->db->table('user')->insert($data);
    }
}
