<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SppdPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sppd_id' => 1,
                'nip' => '197710122006041007',
                'idskpd' => 'SKPD1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 2,
                'nip' => '196910181992112001',
                'idskpd' => 'SKPD2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 3,
                'nip' => '198605152009031004',
                'idskpd' => 'SKPD3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sppd_id' => 4,
                'nip' => '199106132014022002',
                'idskpd' => 'SKPD4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('sppd_pegawais')->insert($data);
    }
}
