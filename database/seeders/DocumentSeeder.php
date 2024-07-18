<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            ['dok_surat' => 'suratmasuk1.pdf', 'name' => 'Surat Masuk 1'],
            ['dok_surat' => 'suratmasuk2.pdf', 'name' => 'Surat Masuk 2'],
            ['dok_surat' => 'suratmasuk3.pdf', 'name' => 'Surat Masuk 3'],
            ['dok_surat' => 'suratmasuk4.pdf', 'name' => 'Surat Masuk 4'],
        ];

        foreach ($documents as $document) {
            DB::table('documents')->insert($document);
        }
    }
}
