<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SoalSeeder extends Seeder
{
    public function run()
    {
        // Ambil kategori_id dari DB
        $kategoriMap = [];
        $kategori = $this->db->table('kategori')->get()->getResultArray();
        foreach ($kategori as $row) {
            $kategoriMap[strtolower($row['kode'])] = $row['id'];
        }

        $data = [];

        // Level 1: Numerik (20 soal)
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'level'       => 1,
                'kategori_id' => $kategoriMap['numerik'],
                'foto'        => null,
                'soal'        => "What is the number $i?",
                'pilihan_a'   => (string)($i - 1),
                'pilihan_b'   => (string)$i,
                'pilihan_c'   => (string)($i + 1),
                'pilihan_d'   => (string)($i + 2),
                'jawaban'     => 'B',
                'bobot_nilai' => 1,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
        }

        // Level 2: Color (10 soal)
        $colors = ['Red', 'Blue', 'Green', 'Yellow', 'Black', 'White', 'Pink', 'Orange', 'Purple', 'Brown'];
        foreach ($colors as $color) {
            $data[] = [
                'level'       => 2,
                'kategori_id' => $kategoriMap['color'],
                'foto'        => null,
                'soal'        => "Which one is $color?",
                'pilihan_a'   => $color,
                'pilihan_b'   => 'Option B',
                'pilihan_c'   => 'Option C',
                'pilihan_d'   => 'Option D',
                'jawaban'     => 'A',
                'bobot_nilai' => 1,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
        }

        // Level 3: Greeting (10 soal)
        $greetings = [
            'Good Morning',
            'Good Afternoon',
            'Good Evening',
            'Good Night',
            'Hello',
            'Hi',
            'How are you?',
            'Nice to meet you',
            'See you later',
            'Goodbye'
        ];
        foreach ($greetings as $greet) {
            $data[] = [
                'level'       => 3,
                'kategori_id' => $kategoriMap['greeting'],
                'foto'        => null,
                'soal'        => "Select the correct greeting: $greet",
                'pilihan_a'   => $greet,
                'pilihan_b'   => 'Option B',
                'pilihan_c'   => 'Option C',
                'pilihan_d'   => 'Option D',
                'jawaban'     => 'A',
                'bobot_nilai' => 1,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
        }

        // Level 4: Family (10 soal)
        $families = [
            'Father',
            'Mother',
            'Brother',
            'Sister',
            'Uncle',
            'Aunt',
            'Cousin',
            'Nephew',
            'Grandfather',
            'Grandmother'
        ];
        foreach ($families as $fam) {
            $data[] = [
                'level'       => 4,
                'kategori_id' => $kategoriMap['family'],
                'foto'        => null,
                'soal'        => "Which one is $fam?",
                'pilihan_a'   => $fam,
                'pilihan_b'   => 'Option B',
                'pilihan_c'   => 'Option C',
                'pilihan_d'   => 'Option D',
                'jawaban'     => 'A',
                'bobot_nilai' => 1,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
        }

        // Insert batch
        $this->db->table('soal')->insertBatch($data);
    }
}
