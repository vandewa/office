<?php

namespace Database\Seeders;

use App\Models\Ssh;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterDasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sshs')->truncate();
        $data = [
            ['nama' => 'Peraturan Bupati Kabupaten Wonosobo Nomor 46 Tahun 2022 tentang Standar Satuan Harga dan Standar Biaya Umum Pemerintah Kabupaten Wonosobo Tahun Anggaran 2023;'],
        ];

        foreach ($data as $datum) {
            Ssh::create($datum);
        }
    }
}
