<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuratMasukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'document_id' => null,
                'jenis_agenda_tp' => 'Agenda TP 1',
                'kode_lama' => 'KL001',
                'kode_baru' => 'KB001',
                'nomor_surat' => '001/ABC/2024',
                'opd_id' => 'OPD001',
                'tgl_surat' => '2024-07-18',
                'tgl_terima' => '2024-07-19',
                'acara' => 'Rapat Koordinasi',
                'tanggalBerangkat' => '2024-07-20',
                'tanggalPulang' => '2024-07-21',
                'jamMulai' => '09:00:00',
                'tempat' => 'Ruang Rapat A',
                'perihal' => 'Koordinasi Proyek',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'document_id' => null,
                'jenis_agenda_tp' => 'Agenda TP 2',
                'kode_lama' => 'KL002',
                'kode_baru' => 'KB002',
                'nomor_surat' => '002/DEF/2024',
                'opd_id' => 'OPD002',
                'tgl_surat' => '2024-07-18',
                'tgl_terima' => '2024-07-20',
                'acara' => 'Pelatihan Teknologi',
                'tanggalBerangkat' => '2024-07-22',
                'tanggalPulang' => '2024-07-23',
                'jamMulai' => '10:00:00',
                'tempat' => 'Aula Utama',
                'perihal' => 'Pelatihan Sistem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'document_id' => null,
                'jenis_agenda_tp' => 'Agenda TP 3',
                'kode_lama' => 'KL003',
                'kode_baru' => 'KB003',
                'nomor_surat' => '003/GHI/2024',
                'opd_id' => 'OPD003',
                'tgl_surat' => '2024-07-19',
                'tgl_terima' => '2024-07-20',
                'acara' => 'Seminar Nasional',
                'tanggalBerangkat' => '2024-07-25',
                'tanggalPulang' => '2024-07-26',
                'jamMulai' => '08:00:00',
                'tempat' => 'Gedung Serbaguna',
                'perihal' => 'Seminar Teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'document_id' => null,
                'jenis_agenda_tp' => 'Agenda TP 4',
                'kode_lama' => 'KL004',
                'kode_baru' => 'KB004',
                'nomor_surat' => '004/JKL/2024',
                'opd_id' => 'OPD004',
                'tgl_surat' => '2024-07-20',
                'tgl_terima' => '2024-07-21',
                'acara' => 'Workshop Pengembangan',
                'tanggalBerangkat' => '2024-07-28',
                'tanggalPulang' => '2024-07-29',
                'jamMulai' => '09:00:00',
                'tempat' => 'Ruang Workshop',
                'perihal' => 'Pengembangan Aplikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    // Masukkan data ke dalam tabel menggunakan DB::insert
    DB::table('surat_masuks')->insert($data);
}
}
