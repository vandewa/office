<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TindakLanjutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data1 = [
            [
                'surat_masuk_id' => 1,
                'nip' => '1987654321',
                'nama' => 'Ahmad',
                // 'surat_keluar_id' => 1,
                'deskripsi' => 'Tindak lanjut surat masuk 1',
                'diteruskan_kepada' => 'Kepala Dinas',
                'disposisi' => 'Segera ditindaklanjuti',
                'revisi' => false,
                'metode_ttd' => 'Tanda_Tangan_Online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 2,
                'nip' => '1987654322',
                'nama' => 'Budi',
                // 'surat_keluar_id' => 2,
                'deskripsi' => 'Tindak lanjut surat masuk 2',
                'diteruskan_kepada' => 'Sekretaris Dinas',
                'disposisi' => 'Perlu dikoreksi',
                'revisi' => true,
                'metode_ttd' => 'Tanda_Tangan_Offline',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 3,
                'nip' => '1987654323',
                'nama' => 'Charlie',
                // 'surat_keluar_id' => 3,
                'deskripsi' => 'Tindak lanjut surat masuk 3',
                'diteruskan_kepada' => 'Staf IT',
                'disposisi' => 'Sudah selesai',
                'revisi' => false,
                'metode_ttd' => 'Tanda_Tangan_Online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_masuk_id' => 4,
                'nip' => '1987654324',
                'nama' => 'Dewi',
                // 'surat_keluar_id' => 4,
                'deskripsi' => 'Tindak lanjut surat masuk 4',
                'diteruskan_kepada' => 'Bagian Keuangan',
                'disposisi' => 'Tunggu persetujuan',
                'revisi' => true,
                'metode_ttd' => 'Tanda_Tangan_Offline',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tindak_lanjuts')->insert($data1);

        $data = [
            [
                // 'surat_masuk_id' => 1,
                'nip' => '1987654325',
                'nama' => 'Erik',
                'surat_keluar_id' => 1,
                'deskripsi' => 'Tindak lanjut surat masuk 1 (Erik)',
                'diteruskan_kepada' => 'Bagian Hukum',
                'disposisi' => 'Perlu ditinjau',
                'revisi' => false,
                'metode_ttd' => 'Tanda_Tangan_Online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'surat_masuk_id' => 2,
                'nip' => '1987654326',
                'nama' => 'Fajar',
                'surat_keluar_id' => 2,
                'deskripsi' => 'Tindak lanjut surat masuk 2 (Fajar)',
                'diteruskan_kepada' => 'Kepala Bagian',
                'disposisi' => 'Segera diproses',
                'revisi' => true,
                'metode_ttd' => 'Tanda_Tangan_Offline',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'surat_masuk_id' => 3,
                'nip' => '1987654327',
                'nama' => 'Gina',
                'surat_keluar_id' => 3,
                'deskripsi' => 'Tindak lanjut surat masuk 3 (Gina)',
                'diteruskan_kepada' => 'Bagian Umum',
                'disposisi' => 'Sudah diperiksa',
                'revisi' => false,
                'metode_ttd' => 'Tanda_Tangan_Online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'surat_masuk_id' => 4,
                'nip' => '1987654328',
                'nama' => 'Hana',
                'surat_keluar_id' => 4,
                'deskripsi' => 'Tindak lanjut surat masuk 4 (Hana)',
                'diteruskan_kepada' => 'Bagian Pengadaan',
                'disposisi' => 'Menunggu keputusan',
                'revisi' => true,
                'metode_ttd' => 'Tanda_Tangan_Offline',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('tindak_lanjuts')->insert($data);
    }
}
