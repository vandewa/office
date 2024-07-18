<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DasarSppdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sppd_id' => 1,
                'dasar' => 'Peraturan Pemerintah No. 1 Tahun 2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 2,
                'dasar' => 'Instruksi Presiden No. 2 Tahun 2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 3,
                'dasar' => 'Keputusan Menteri No. 3 Tahun 2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 4,
                'dasar' => 'Surat Edaran Bupati No. 4 Tahun 2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('dasar_sppds')->insert($data);
    }
}
