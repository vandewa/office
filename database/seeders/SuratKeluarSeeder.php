<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuratKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'document_id' => null,
                'nomor_surat' => '123/ABC/2024',
                'jenis_surat' => 'Surat Undangan',
                'tanggal_surat' => '2024-07-18',
                'perihal' => 'Undangan Rapat',
                'tujuan' => 'Kepala Dinas',
                'tempat_tujuan' => 'Ruang Rapat A',
                'pembukaan' => 'Dengan hormat,',
                'isi' => 'Kami mengundang Bapak/Ibu untuk hadir pada rapat...',
                'hari' => 'Senin',
                'tanggal' => '2024-07-21',
                'pukul_mulai' => '09:00:00',
                'pukul_selesai' => '11:00:00',
                'tempat_acara' => 'Ruang Rapat A',
                'penutup' => 'Demikian surat ini kami sampaikan...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'document_id' => null,
                'nomor_surat' => '124/DEF/2024',
                'jenis_surat' => 'Surat Tugas',
                'tanggal_surat' => '2024-07-19',
                'perihal' => 'Penugasan Kegiatan',
                'tujuan' => 'Sekretaris Dinas',
                'tempat_tujuan' => 'Kantor Dinas',
                'pembukaan' => 'Dengan ini menugaskan,',
                'isi' => 'Agar hadir dalam kegiatan...',
                'hari' => 'Selasa',
                'tanggal' => '2024-07-22',
                'pukul_mulai' => '10:00:00',
                'pukul_selesai' => '12:00:00',
                'tempat_acara' => 'Kantor Dinas',
                'penutup' => 'Demikian surat tugas ini...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'document_id' => null,
                'nomor_surat' => '125/GHI/2024',
                'jenis_surat' => 'Surat Edaran',
                'tanggal_surat' => '2024-07-20',
                'perihal' => 'Pemberitahuan Cuti',
                'tujuan' => 'Seluruh Pegawai',
                'tempat_tujuan' => 'Dinas Kominfo',
                'pembukaan' => 'Dengan hormat,',
                'isi' => 'Kami memberitahukan bahwa...',
                'hari' => 'Rabu',
                'tanggal' => '2024-07-23',
                'pukul_mulai' => '08:00:00',
                'pukul_selesai' => '09:00:00',
                'tempat_acara' => 'Dinas Kominfo',
                'penutup' => 'Demikian pemberitahuan ini...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'document_id' => null,
                'nomor_surat' => '126/JKL/2024',
                'jenis_surat' => 'Surat Pemberitahuan',
                'tanggal_surat' => '2024-07-21',
                'perihal' => 'Pemberitahuan Acara',
                'tujuan' => 'Kepala Seksi',
                'tempat_tujuan' => 'Aula Dinas',
                'pembukaan' => 'Dengan hormat,',
                'isi' => 'Kami memberitahukan bahwa acara...',
                'hari' => 'Kamis',
                'tanggal' => '2024-07-24',
                'pukul_mulai' => '13:00:00',
                'pukul_selesai' => '15:00:00',
                'tempat_acara' => 'Aula Dinas',
                'penutup' => 'Demikian pemberitahuan ini...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        // Masukkan data ke dalam tabel menggunakan Query Builder
        DB::table('surat_keluars')->insert($data);
    }
}
