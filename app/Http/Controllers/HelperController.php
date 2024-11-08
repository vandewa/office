<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ssh;
use App\Models\Sppd;
use App\Models\DasarSppd;
use App\Models\LaporanSppd;
use App\Models\Simpeg\Tb01;
use App\Models\SppdPegawai;
use App\Models\InformasiOpd;
use App\Models\Simpeg\ASkpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class HelperController extends Controller
{

    public function showPicture(Request $request)
    {
        if (Storage::exists($request->path)) {
            return Storage::response($request->path);
        }

        return "File tidak ditemukan";
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('index'));

    }

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

        // Format nama kepala
        $nama_kepala = $this->formatNamaGelar($kepalaDinas);

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
            'kepala' => $nama_kepala ?? '',
            'kepala_nip' => $kepalaDinas->nip ?? "",
            'kepala_pangkat' => $kepalaDinas->pangkat,
            'alamat' => $informasiOpd->alamat ?? '',
            'fax' => $informasiOpd->fax ?? '',
            'website' => $informasiOpd->website ?? '',
            'email' => $informasiOpd->email ?? '',
            'telepon' => $informasiOpd->telepon ?? '',
            'dasar' => $dasarSppd->dasar ?? '',
            'ssh' => $ssh->nama ?? "",
        ]);

        // dd($kampret2);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $templateProcessor->cloneBlock('block_name', count($kampret2), true, false, $kampret2);

        $templateProcessor->saveAs($pathSave);

        return response()->download($pathSave)->deleteFileAfterSend(true);

    }

    public function cetakSPTKepala($id)
    {
        $informasiOpd = InformasiOpd::where('kdunit', auth()->user()->kdunit)->first();
        $ssh = Ssh::first();
        $dasarSppd = DasarSppd::where('sppd_id', $id)->first();
        $sppd = Sppd::find($id);
        $pegawai = SppdPegawai::where('sppd_id', $id)->first();

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

        // Format nama kepala
        $nama_kepala = $this->formatNamaGelar($kepalaDinas);

        $path = public_path('template/spt_kepala.docx');

        $pathSave = public_path('dokumen/' . 'SPT ' . Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y') . ' ' . $sppd->tempat_tujuan . '.docx');

        $templateProcessor = new TemplateProcessor($path);

        $templateProcessor->setValues([
            'dasar' => $dasarSppd->dasar ?? null,
            'ssh' => $ssh->nama ?? null,
            'untuk' => ucfirst($sppd->untuk) ?? null,

            'nama' => $nama_kepala,
            'nip' => $kepalaDinas->nip,
            'pangkat' => $kepalaDinas->pangkat,
            'golongan' => $kepalaDinas->golru,
            'jabatan' => $kepalaDinas->jabatan,
            'tanggal' => Carbon::createFromFormat('Y-m-d', $sppd->ditetapkan_tgl)->isoFormat('D MMMM Y'),

            'sekda' => $this->sekda()

        ]);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
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

        // Format nama kepala
        $namaKepala = $this->formatNamaGelar($kepala);

        // Format nama kepala
        $namaDanGelar = $this->formatNamaGelar($pegawai);

        $path = public_path('template/spd.docx');

        $pathSave = public_path('dokumen/' . 'SPPD ' . $pegawai->nama . Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y') . ' ' . $sppd->tempat_tujuan . '.docx');

        $templateProcessor = new TemplateProcessor($path);

        $templateProcessor->setValues([
            'opd' => strtoupper($opd->skpd) ?? null,
            'alamat' => $informasiOpd->alamat ?? null,
            'fax' => $informasiOpd->fax ?? null,
            'website' => $informasiOpd->website ?? null,
            'email' => $informasiOpd->email ?? null,
            'telepon' => $informasiOpd->telepon ?? null,

            'kepala' => $namaKepala ?? null,
            'kepala_nip' => $kepala->nip ?? null,

            'nama' => $namaDanGelar ?? null,
            'nip' => $pegawai->nip ?? null,
            'pangkat' => $pegawai->pangkat ?? null,
            'golongan' => $pegawai->golru ?? null,
            'jabatan' => $pegawai->jabatan ?? null,

            'tingkat' => $sppd->tingkat_id ?? null,
            'maksud' => $sppd->maksud ?? null,
            'alat_angkut' => $sppd->kendaraan->code_nm ?? null,
            'tmpt_berangkat' => $sppd->tempat_berangkat ?? null,
            'tmpt_tujuan' => $sppd->tempat_tujuan ?? null,
            'hari' => $this->angkaKeTeks($sppd->hari),
            'hari2' => $sppd->hari,
            'berangkat' => Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y'),
            'pulang' => Carbon::createFromFormat('Y-m-d', $sppd->tgl_kembali)->isoFormat('D MMMM Y'),
            'instansi' => $opd->skpd ?? null,
            'akun' => $informasiOpd->akun ?? null,
            'keterangan' => $sppd->keterangan,
            'tanggal' => Carbon::createFromFormat('Y-m-d', $sppd->ditetapkan_tgl)->isoFormat('D MMMM Y'),

        ]);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

        $templateProcessor->saveAs($pathSave);

        return response()->download($pathSave)->deleteFileAfterSend(true);

    }

    public function cetakSPPDKepala($id, $userId)
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

        // Format nama kepala
        $namaKepala = $this->formatNamaGelar($kepala);

        $path = public_path('template/spd_kepala.docx');

        $pathSave = public_path('dokumen/' . 'SPPD ' . $namaKepala . Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y') . ' ' . $sppd->tempat_tujuan . '.docx');

        $templateProcessor = new TemplateProcessor($path);

        $templateProcessor->setValues([
            'opd' => strtoupper($opd->skpd) ?? null,
            'alamat' => $informasiOpd->alamat ?? null,
            'fax' => $informasiOpd->fax ?? null,
            'website' => $informasiOpd->website ?? null,
            'email' => $informasiOpd->email ?? null,
            'telepon' => $informasiOpd->telepon ?? null,

            'nama' => $namaKepala ?? null,
            'nip' => $kepala->nip ?? null,
            'pangkat' => $kepala->pangkat ?? null,
            'golongan' => $kepala->golru ?? null,
            'jabatan' => $kepala->jabatan ?? null,

            'tingkat' => $sppd->tingkat_id ?? null,
            'maksud' => $sppd->maksud ?? null,
            'alat_angkut' => $sppd->kendaraan->code_nm ?? null,
            'tmpt_berangkat' => $sppd->tempat_berangkat ?? null,
            'tmpt_tujuan' => $sppd->tempat_tujuan ?? null,
            'hari' => $this->angkaKeTeks($sppd->hari),
            'hari2' => $sppd->hari ?? null,
            'berangkat' => Carbon::createFromFormat('Y-m-d', $sppd->tgl_berangkat)->isoFormat('D MMMM Y'),
            'pulang' => Carbon::createFromFormat('Y-m-d', $sppd->tgl_kembali)->isoFormat('D MMMM Y'),
            'instansi' => $opd->skpd ?? null,
            'akun' => $informasiOpd->akun ?? null,
            'keterangan' => $sppd->keterangan,
            'tanggal' => Carbon::createFromFormat('Y-m-d', $sppd->ditetapkan_tgl)->isoFormat('D MMMM Y'),

            'sekda' => $this->sekda()

        ]);

        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $templateProcessor->saveAs($pathSave);
        return response()->download($pathSave)->deleteFileAfterSend(true);

    }

    public function cetakLaporanSPPD($id)
    {
        $data = LaporanSppd::with(['sppdnya'])->where('sppd_id', $id)->first();
        $pegawai = SppdPegawai::where('sppd_id', $id)->get();
        $ssh = Ssh::first();
        $dasarSppd = DasarSppd::where('sppd_id', $id)->first();

        $kumpulanPegawai = [];
        foreach ($pegawai as $list) {
            $kumpulanPegawai[] = $list->nip;
        }

        //mendapatkan detail data para pegawai
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

        //cek data yang membuat
        $createdBy = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
        when jabfung is null then jabfungum
        else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->where('nip', $data->nip)
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->first();

        //path master template
        $path = public_path('/template/laporan_perjalanan_dinas.docx');

        //nama file
        $pathSave = storage_path('app/public/' . 'Laporan Perjalanan Dinas ' . Carbon::createFromFormat('Y-m-d', $data->sppdnya->tgl_berangkat)->isoFormat('D MMMM Y') . ' ' . $data->sppdnya->tempat_tujuan . '.docx');

        //cek tanggal sama atau tidak
        if ($data->sppdnya->tgl_berangkat == $data->sppdnya->tgl_kembali) {
            $tgl_pelaksanaan = Carbon::createFromFormat('Y-m-d', $data->sppdnya->tgl_berangkat)->isoFormat('D MMMM Y');
        } else {
            $tgl_pelaksanaan = Carbon::createFromFormat('Y-m-d', $data->sppdnya->tgl_berangkat)->isoFormat('D MMMM Y') . ' - ' . Carbon::createFromFormat('Y-m-d', $data->sppdnya->tgl_kembali)->isoFormat('D MMMM Y');

        }


        $templateProcessor = new TemplateProcessor($path);
        $templateProcessor->setValues([
            'maksud_atas' => strtoupper($data->sppdnya->maksud),
            'maksud' => $data->sppdnya->maksud,
            'tanggal_pelaksanaan' => $tgl_pelaksanaan,
            'tujuan' => $data->sppdnya->tempat_tujuan,
            'tanggal' => Carbon::createFromFormat('Y-m-d', $data->tanggal)->isoFormat('D MMMM Y'),
            'nama' => $createdBy->nama,
            'nip' => $createdBy->nip,
            'hasil' => $data->laporan,
            'dasar' => $dasarSppd->dasar,
            'ssh' => $ssh->nama,
        ]);

        $kampret2 = [];
        foreach ($cekPegawai as $index => $a2) {
            //cek gelar depan dan belakang
            $namaDanGelar = ($a2->gdp ? $a2->gdp . ' ' : '') . $a2->nama . ($a2->gdb ? ', ' . $a2->gdb : '');

            array_push($kampret2, [
                'pegawai' => $namaDanGelar,
                'jabatan' => $a2->jabatan
            ]);

        }


        // }
        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $templateProcessor->cloneBlock('block_name', count($kampret2), true, false, $kampret2);
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

    private function sekda()
    {
        //cek sekretaris daerah
        $sekda = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
           when jabfung is null then jabfungum
           else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->where('tb_01.idskpd', '02')
            ->where('idjenkedudupeg', 1) //aktif / tidak
            ->where('idjenjab', '20')
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->first();

        return strtoupper($sekda->nama);

    }

    private function formatNamaGelar($person)
    {
        return ($person->gdp ? $person->gdp . ' ' : '') . $person->nama . ($person->gdb ? ', ' . $person->gdb : '');
    }
}