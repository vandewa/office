<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSuratSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'surat_masuk_id' => 1,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 2,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 3,
                'surat_keluar_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 4,
                'surat_keluar_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => null,
                'surat_keluar_id' => 1,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => null,
                'surat_keluar_id' => 2,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => null,
                'surat_keluar_id' => 3,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => null,
                'surat_keluar_id' => 4,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        // Masukkan data ke dalam tabel menggunakan DB::insert
        DB::table('status_surats')->insert($data);
    }
}
