<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sppd_id' => 1,
                'status_laporan' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 2,
                'status_laporan' => 'Belum Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 3,
                'status_laporan' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 4,
                'status_laporan' => 'Belum Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('status_laporans')->insert($data);
    }
}
