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
    public $skpd;
    public $data;
    public function mount()
    {
        $this->skpd = ASkpd::where('kdunit', auth()->user()->kdunit)->first();

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
            ->where('tb_01.idskpd', 'like', auth()->user()->kdunit . '%')
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
