<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSuratSeeder extends Seeder
{
    public function run()
    {
        // Buat data status surat masuk secara manual
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
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 3,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 4,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 5,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 6,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 7,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_masuk_id' => 8,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 9,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 10,
                'surat_keluar_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 11,
                'surat_keluar_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 12,
                'surat_keluar_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_masuk_id' => 13,
                'surat_keluar_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 14,
                'surat_keluar_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 15,
                'surat_keluar_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 16,
                'surat_keluar_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 17,
                'surat_keluar_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_masuk_id' => 18,
                'surat_keluar_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 19,
                'surat_keluar_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 20,
                'surat_keluar_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],



            [
                'surat_keluar_id' => 1,
                'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 2,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 3,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 4,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 5,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'surat_keluar_id' => 6,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 7,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 8,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 9,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 10,
                 'surat_masuk_id' => null,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'surat_keluar_id' => 11,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 12,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 13,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 14,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 15,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sekretariat',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'surat_keluar_id' => 16,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 17,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 18,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'surat_keluar_id' => 19,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_keluar_id' => 20,
                 'surat_masuk_id' => null,
                'status_surat' => 'Sudah Distribusikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Masukkan data ke dalam tabel menggunakan DB::insert
        DB::table('status_surats')->insert($data);
    }
}
