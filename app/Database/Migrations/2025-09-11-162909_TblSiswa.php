<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'nama'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'username'  => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'password'  => ['type' => 'VARCHAR', 'constraint' => 255], // hash password
            'guru_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('guru_id', 'user', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('siswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('siswa', true);
    }
}
