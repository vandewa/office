<?php

namespace Database\Seeders;

use App\Models\ComCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('com_codes')->truncate();

        $data = [
            ['com_cd' => 'STATUS_LAPORAN_TP_01', 'code_nm' => 'Belum Selesai', 'code_group' => 'STATUS_LAPORAN_TP', 'code_value' => ''],
            ['com_cd' => 'STATUS_LAPORAN_TP_02', 'code_nm' => 'Selesai', 'code_group' => 'STATUS_LAPORAN_TP', 'code_value' => ''],
            ['com_cd' => 'ALAT_ANGKUT_ST_01', 'code_nm' => 'Kendaraan Dinas', 'code_group' => 'ALAT_ANGKUT_ST', 'code_value' => ''],
            ['com_cd' => 'ALAT_ANGKUT_ST_02', 'code_nm' => 'Kendaraan Umum', 'code_group' => 'ALAT_ANGKUT_ST', 'code_value' => ''],
            ['com_cd' => 'SURAT_TP_01', 'code_nm' => 'Agenda', 'code_group' => 'SURAT_TP', 'code_value' => ''],
            ['com_cd' => 'SURAT_TP_02', 'code_nm' => 'Non Agenda', 'code_group' => 'SURAT_TP', 'code_value' => ''],
            ['com_cd' => 'DISPOSISI_TP_01', 'code_nm' => 'Disposisi', 'code_group' => 'DISPOSISI_TP', 'code_value' => 'Disposisi'],
            ['com_cd' => 'DISPOSISI_TP_02', 'code_nm' => 'CC', 'code_group' => 'DISPOSISI_TP', 'code_value' => 'Carbon Copy'],
        ];

        foreach ($data as $item) {
            ComCode::create($item);
        }
    }
}
