<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveGuruIdFromNilai extends Migration
{
    public function up()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('nilai', 'nilai_guru_id_foreign');
        
        // Then drop the column
        $this->forge->dropColumn('nilai', 'guru_id');
    }

    public function down()
    {
        // Add column back
        $this->forge->addColumn('nilai', [
            'guru_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'siswa_id'
            ]
        ]);
        
        // Add foreign key back
        $this->forge->processIndexes('nilai');
        $this->db->query('ALTER TABLE nilai ADD CONSTRAINT nilai_guru_id_foreign FOREIGN KEY (guru_id) REFERENCES user(id) ON DELETE SET NULL ON UPDATE SET NULL');
    }
}
