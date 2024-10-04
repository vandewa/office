<?php

namespace App\Http\Controllers;

use App\Models\DasarSppd;
use App\Models\InformasiOpd;
use App\Models\SppdPegawai;
use Carbon\Carbon;
use App\Models\Sppd;
use App\Models\Simpeg\Tb01;
use App\Models\Simpeg\ASkpd;
use App\Models\Ssh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class HelperController extends Controller
{
    public function cetakSPT($id)
    {
        $informasiOpd = InformasiOpd::where('kdunit', auth()->user()->kdunit)->first();
        $ssh = Ssh::first();
        $dasarSppd = DasarSppd::where('sppd_id', $id)->first();
        $sppd = Sppd::find($id);
        $opd = ASkpd::find($sppd->kdunit);
        $pegawai = SppdPegawai::where('sppd_id', $id)->get();
        $kumpulanPegawai = [];

        foreach ($pegawai as $list) {
            $kumpulanPegawai[] = $list->nip;
        }

        //cek kepala opd
        $kepalaDinas = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
           when jabfung is null then jabfungum
           else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->where('tb_01.kdunit', $sppd->kdunit) //kode opd
            ->where('idjenkedudupeg', 1) //aktif / tidak
            ->where('idjenjab', '>', '4')
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->first();

        $cekPegawai = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
            when jabfung is null then jabfungum
            else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->whereIn('nip', $kumpulanPegawai)
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->get();


        //cek gelar depan dan belakang
        $nama_kepala = ($kepalaDinas->gdp ? $kepalaDinas->gdp . ' ' : '') . $kepalaDinas->nama . ($kepalaDinas->gdb ? ', ' . $kepalaDinas->gdb : '');


        $path = public_path('template/spt.docx');

        $pathSave = public_path('dokumen/' . 'SPT ' . Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y') . ' ' . $sppd->tempat_tujuan . '.docx');

        $templateProcessor = new TemplateProcessor($path);

        // $kampret = [];
        $kampret2 = [];

        foreach ($cekPegawai as $index => $a2) {

            //cek gelar depan dan belakang
            $namaDanGelar = ($a2->gdp ? $a2->gdp . ' ' : '') . $a2->nama . ($a2->gdb ? ', ' . $a2->gdb : '');

            //jika lebih dari 1 orang
            $dewa = [
                'kepada' => '',
                'i2' => '',
                'o' => $index + 1,
                'nama' => $namaDanGelar,
                'nip' => $a2->nip,
                'pangkat' => $a2->pangkat,
                'golongan' => $a2->golru,
                'jabatan' => $a2->jabatan,
            ];

            //jika hanya 1 orang 
            if ($index == 0) {
                $dewa = [
                    'kepada' => 'Kepada',
                    'i2' => ':',
                    'o' => $index + 1,
                    'nama' => $namaDanGelar,
                    'nip' => $a2->nip,
                    'pangkat' => $a2->pangkat,
                    'golongan' => $a2->golru,
                    'jabatan' => $a2->jabatan,
                ];
            }

            array_push($kampret2, $dewa);
        }

        $templateProcessor->setValues([
            'untuk' => ucfirst($sppd->untuk),
            'tanggal' => Carbon::createFromFormat('Y-m-d', $sppd->ditetapkan_tgl)->isoFormat('D MMMM Y'),
            'opd' => strtoupper($opd->skpd ?? ''),
            'kepala' => $nama_kepala,
            'kepala_nip' => $kepalaDinas->nip,
            'kepala_pangkat' => $kepalaDinas->pangkat,
            'alamat' => $informasiOpd->alamat,
            'fax' => $informasiOpd->fax,
            'website' => $informasiOpd->website,
            'email' => $informasiOpd->email,
            'telepon' => $informasiOpd->telepon,
            'dasar' => $dasarSppd->dasar,
            'ssh' => $ssh->nama,
        ]);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $templateProcessor->cloneBlock('block_name', count($kampret2), true, false, $kampret2);

        $templateProcessor->saveAs($pathSave);

        return response()->download($pathSave)->deleteFileAfterSend(true);

    }

    public function cetakSPPD($id, $userId)
    {
        $sppd = Sppd::with(['kendaraan'])->find($id);
        $informasiOpd = InformasiOpd::where('kdunit', auth()->user()->kdunit)->first();
        $opd = ASkpd::find(auth()->user()->kdunit);

        //cek kepala opd
        $kepala = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
           when jabfung is null then jabfungum
           else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->where('tb_01.kdunit', auth()->user()->kdunit) //kode opd
            ->where('idjenkedudupeg', 1) //aktif / tidak
            ->where('idjenjab', '>', '4')
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->first();

        //cek pegawai
        $pegawai = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
            when jabfung is null then jabfungum
            else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->where('nip', $userId)
            ->first();

        //cek gelar depan dan belakang kepala opd
        $namaKepala = ($kepala->gdp ? $kepala->gdp . ' ' : '') . $kepala->nama . ($kepala->gdb ? ', ' . $kepala->gdb : '');

        //cek gelar depan dan belakang  pegawai
        $namaDanGelar = ($pegawai->gdp ? $pegawai->gdp . ' ' : '') . $pegawai->nama . ($pegawai->gdb ? ', ' . $pegawai->gdb : '');

        $path = public_path('template/spd.docx');

        $pathSave = public_path('dokumen/' . 'SPPD ' . $pegawai->nama . Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y') . ' ' . $sppd->tempat_tujuan . '.docx');

        $templateProcessor = new TemplateProcessor($path);

        $templateProcessor->setValues([
            'opd' => strtoupper($opd->skpd),
            'alamat' => $informasiOpd->alamat,
            'fax' => $informasiOpd->fax,
            'website' => $informasiOpd->website,
            'email' => $informasiOpd->email,
            'telepon' => $informasiOpd->telepon,

            'kepala' => $namaKepala,
            'kepala_nip' => $kepala->nip,

            'nama' => $namaDanGelar,
            'nip' => $pegawai->nip,
            'pangkat' => $pegawai->pangkat,
            'golongan' => $pegawai->golru,
            'jabatan' => $pegawai->jabatan,

            'tingkat' => $sppd->tingkat_id,
            'maksud' => $sppd->maksud,
            'alat_angkut' => $sppd->kendaraan->code_nm,
            'tmpt_berangkat' => $sppd->tempat_berangkat,
            'tmpt_tujuan' => $sppd->tempat_tujuan,
            'hari' => $this->angkaKeTeks($sppd->hari),
            'hari2' => $sppd->hari,
            'berangkat' => Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y'),
            'pulang' => Carbon::createFromFormat('Y-m-d', $sppd->tgl_kembali)->isoFormat('D MMMM Y'),
            'instansi' => $opd->skpd,
            'akun' => $informasiOpd->akun ?? null,
            'keterangan' => $sppd->keterangan,
            'tanggal' => Carbon::createFromFormat('Y-m-d', $sppd->ditetapkan_tgl)->isoFormat('D MMMM Y'),

        ]);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

        $templateProcessor->saveAs($pathSave);

        return response()->download($pathSave)->deleteFileAfterSend(true);

    }

    private function angkaKeTeks($angka)
    {
        $teks = "";
        $satuan = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

        $teks = $satuan[$angka];

        return $teks;
    }
}
