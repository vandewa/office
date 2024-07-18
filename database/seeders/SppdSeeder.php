<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SppdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'maksud' => 'Perjalanan Dinas ke Jakarta',
                'untuk' => 'Rapat Koordinasi',
                'tingkat_id' => 'A',
                'alat_angkut_st' => 'Pesawat',
                'tempat_berangkat' => 'Bandung',
                'tempat_tujuan' => 'Jakarta',
                'tgl_berangkat' => '2024-08-01',
                'tgl_kembali' => '2024-08-03',
                'hari' => 'Senin',
                'ditetapkan_tgl' => '2024-07-20',
                'pengikut' => 'Ahmad, Budi',
                'keterangan' => 'Membawa dokumen penting',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maksud' => 'Kunjungan Kerja ke Surabaya',
                'untuk' => 'Inspeksi Proyek',
                'tingkat_id' => 'B',
                'alat_angkut_st' => 'Kereta Api',
                'tempat_berangkat' => 'Yogyakarta',
                'tempat_tujuan' => 'Surabaya',
                'tgl_berangkat' => '2024-08-05',
                'tgl_kembali' => '2024-08-07',
                'hari' => 'Selasa',
                'ditetapkan_tgl' => '2024-07-21',
                'pengikut' => 'Charlie, Dewi',
                'keterangan' => 'Melakukan evaluasi proyek',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maksud' => 'Pelatihan di Bali',
                'untuk' => 'Pelatihan Pengembangan SDM',
                'tingkat_id' => 'C',
                'alat_angkut_st' => 'Bus',
                'tempat_berangkat' => 'Malang',
                'tempat_tujuan' => 'Bali',
                'tgl_berangkat' => '2024-08-10',
                'tgl_kembali' => '2024-08-12',
                'hari' => 'Rabu',
                'ditetapkan_tgl' => '2024-07-22',
                'pengikut' => 'Erik, Fajar',
                'keterangan' => 'Mengikuti pelatihan intensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'maksud' => 'Seminar di Medan',
                'untuk' => 'Seminar Nasional',
                'tingkat_id' => 'D',
                'alat_angkut_st' => 'Pesawat',
                'tempat_berangkat' => 'Jakarta',
                'tempat_tujuan' => 'Medan',
                'tgl_berangkat' => '2024-08-15',
                'tgl_kembali' => '2024-08-17',
                'hari' => 'Kamis',
                'ditetapkan_tgl' => '2024-07-23',
                'pengikut' => 'Gina, Hana',
                'keterangan' => 'Presentasi hasil penelitian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('sppds')->insert($data);
    }
}
