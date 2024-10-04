<?php

namespace Database\Seeders;

use App\Models\Opd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('opds')->truncate();
        $data = [
            ['nama_opd' => 'SETDA', 'nama_opd_lengkap' => 'Sekretariat Daerah'],
            ['nama_opd' => 'DINSOSPMD', 'nama_opd_lengkap' => 'Dinas Sosial, Pemberdayaan Masyarakat dan Desa'],
            ['nama_opd' => 'BAKESBANGPOL', 'nama_opd_lengkap' => 'Badan Kesatuan Bangsa dan Politik'],
            ['nama_opd' => 'INSPEKTORAT', 'nama_opd_lengkap' => 'Inspektorat'],
            ['nama_opd' => 'DISPAPERKAN', 'nama_opd_lengkap' => 'Dinas Pangan, Pertanian dan Perikanan'],
            ['nama_opd' => 'DINKES', 'nama_opd_lengkap' => 'Dinas Kesehatan'],
            ['nama_opd' => 'DISPARBUD', 'nama_opd_lengkap' => 'Dinas Pariwisata dan Kebudayaan'],
            ['nama_opd' => 'DISNAKERINTRANS', 'nama_opd_lengkap' => 'Dinas Tenaga Kerja, Perindustrian dan Transmigrasi'],
            ['nama_opd' => 'DISDAGKOPUKM', 'nama_opd_lengkap' => 'Dinas Perdagangan, Koperasi, Usaha Kecil dan Menengah'],
            ['nama_opd' => 'DISPERKIMHUB', 'nama_opd_lengkap' => 'Dinas Perumahan, Kawasan Permukiman dan Perhubungan'],
            ['nama_opd' => 'SETWAN', 'nama_opd_lengkap' => 'Sekretariat Dewan Perwakilan Rakyat Daerah'],
            ['nama_opd' => 'DISDIKPORA', 'nama_opd_lengkap' => 'Dinas Pendidikan, Pemuda dan Olahraga'],
            ['nama_opd' => 'DPUPR', 'nama_opd_lengkap' => 'Dinas Pekerjaan Umum dan Penataan Ruang'],
            ['nama_opd' => 'DPPKBPPPA', 'nama_opd_lengkap' => 'Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak'],
            ['nama_opd' => 'DLH', 'nama_opd_lengkap' => 'Dinas Lingkungan Hidup'],
            ['nama_opd' => 'DISDUKCAPIL', 'nama_opd_lengkap' => 'Dinas Kependudukan dan Pencatatan Sipil'],
            ['nama_opd' => 'DISKOMINFO', 'nama_opd_lengkap' => 'Dinas Komunikasi dan Informatika'],
            ['nama_opd' => 'DPMPTSP', 'nama_opd_lengkap' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'],
            ['nama_opd' => 'DISARPUSDA', 'nama_opd_lengkap' => 'Dinas Kearsipan dan Perpustakaan Daerah'],
            ['nama_opd' => 'SATPOL PP', 'nama_opd_lengkap' => 'Satuan Polisi Pamong Praja'],
            ['nama_opd' => 'BAPPEDA', 'nama_opd_lengkap' => 'Badan Perencanaan Pembangunan Daerah'],
            ['nama_opd' => 'BPPKAD', 'nama_opd_lengkap' => 'Badan Pengelolaan Pendapatan, Keuangan dan Aset Daerah'],
            ['nama_opd' => 'BKD', 'nama_opd_lengkap' => 'Badan Kepegawaian Daerah'],
            ['nama_opd' => 'BPBD', 'nama_opd_lengkap' => 'Badan Penanggulangan Bencana Daerah'],
            ['nama_opd' => 'Kec Garung', 'nama_opd_lengkap' => 'Kecamatan Garung'],
            ['nama_opd' => 'Kec Kalibawang', 'nama_opd_lengkap' => 'Kecamatan Kalibawang'],
            ['nama_opd' => 'Kec Kalikajar', 'nama_opd_lengkap' => 'Kecamatan Kalikajar'],
            ['nama_opd' => 'Kec Kaliwiro', 'nama_opd_lengkap' => 'Kecamatan Kaliwiro'],
            ['nama_opd' => 'Kec Kejajar', 'nama_opd_lengkap' => 'Kecamatan Kejajar'],
            ['nama_opd' => 'Kec Kepil', 'nama_opd_lengkap' => 'Kecamatan Kepil'],
            ['nama_opd' => 'Kec Kertek', 'nama_opd_lengkap' => 'Kecamatan Kertek'],
            ['nama_opd' => 'Kec Leksono', 'nama_opd_lengkap' => 'Kecamatan Leksono'],
            ['nama_opd' => 'Kec Mojotengah', 'nama_opd_lengkap' => 'Kecamatan Mojotengah'],
            ['nama_opd' => 'Kec Sapuran', 'nama_opd_lengkap' => 'Kecamatan Sapuran'],
            ['nama_opd' => 'Kec Selomerto', 'nama_opd_lengkap' => 'Kecamatan Selomerto'],
            ['nama_opd' => 'Kec Sukoharjo', 'nama_opd_lengkap' => 'Kecamatan Sukoharjo'],
            ['nama_opd' => 'Kec Wadaslintang', 'nama_opd_lengkap' => 'Kecamatan Wadaslintang'],
            ['nama_opd' => 'Kec Watumalang', 'nama_opd_lengkap' => 'Kecamatan Watumalang'],
            ['nama_opd' => 'Kec Wonosobo', 'nama_opd_lengkap' => 'Kecamatan Wonosobo'],
            ['nama_opd' => 'BUPATI', 'nama_opd_lengkap' => 'Bupati'],
            ['nama_opd' => 'LAINNYA', 'nama_opd_lengkap' => 'Lainnya'],

        ];

        foreach ($data as $datum) {
            Opd::create($datum);
        }
    }
}
