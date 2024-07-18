<?php

namespace App\Livewire\Pegawai;

use Livewire\Component;
use App\Models\Simpeg\Tb01;
use App\Models\Simpeg\ASkpd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPegawai as ModelsDataPegawai;

class DataPegawai extends Component
{
    public $tb01;
    public $askpd;
    public $data;
    public function mount()
    {
        $kdunit = Auth::user()->kdunit;
        // $this->tb01 = Tb01::where('kdunit', $kdunit)->where('idjenkedudupeg', 1)->get();
        $this->askpd = ASkpd::where('kdunit', $kdunit)->get();

        // $this->tb01 = Tb01::with(['skpd'])->select('nip', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'mkthnpkt', 'mkblnpkt', 'tb_01.idskpd', "jabatan.skpd", 'tb_01.idagama', 'nonpwp', 'nokaris', 'tb_01.alm', 'notaspen', 'nobapertarum', 'noaskes', 'hp', 'tmlhr', 'noktp', DB::Raw("
        //     case when jabfung is null and jabfungum is null then jabatan.jab
        //        when jabfung is null then jabfungum
        //        else  jabfung end as jabatan
        //    "), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_agama.agama as agama"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("DATE_FORMAT(tb_01.tglhr,'%d-%m-%Y') as tglLahir"), DB::Raw("induk.skpd as unor") , DB::Raw("induk.kdunit as kode_skpd"), DB::Raw("a_stspeg.stspeg as status"), DB::Raw("a_jenkedudupeg.jenkedudupeg as kedudukan"))
        //     ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
        //     ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
        //     ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
        //     ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
        //     ->leftJoin('a_agama', "tb_01.idagama", "a_agama.idagama")
        //     ->leftJoin('a_stspeg', "tb_01.idstspeg", "a_stspeg.idstspeg")
        //     ->leftJoin('a_jenkedudupeg', "tb_01.idjenkedudupeg", "a_jenkedudupeg.idjenkedudupeg")
        //     ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
        //     ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
        //     ->where('induk.kdunit', $kdunit)
        //     ->where('idjenkedudupeg', 1)
        //     ->get();

        $this->tb01 = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("
         case when jabfung is null and jabfungum is null then jabatan.jab
            when jabfung is null then jabfungum
            else  jabfung end as jabatan
        "), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->where('tb_01.idskpd', 'like', $kdunit . '%')
            ->where('idjenkedudupeg', 1)
            ->orderBy('tb_01.idstspeg', 'asc')
            ->orderBy('tb_01.idgolrupkt', 'desc')
            ->get();

        // dd($this->tb01); 
    }
    public function render()
    {
        return view('livewire.pegawai.data-pegawai');
    }
}
