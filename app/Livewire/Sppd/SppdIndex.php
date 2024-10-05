<?php

namespace App\Livewire\Sppd;

use App\Models\Sppd;
use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\DasarSppd;
use App\Models\Simpeg\Tb01;
use App\Models\SppdPegawai;
use Illuminate\Support\Facades\DB;

class SppdIndex extends Component
{
    public $idHapus, $kepalaDinas;

    public function mount()
    {
        $this->kepalaDinas = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("
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
            ->where('tb_01.kdunit', auth()->user()->kdunit) //kode opd
            ->where('idjenkedudupeg', 1) //aktif / tidak
            ->where('idjenjab', '>', '4')
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->first()
            ->nip;
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->js(<<<'JS'
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Apakah kamu ingin menghapus data ini? proses ini tidak dapat dikembalikan.",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.hapus()
                }
            })
        JS);
    }

    public function hapus()
    {
        Sppd::destroy($this->idHapus);
        DasarSppd::where('sppd_id', $this->idHapus)->delete();
        SppdPegawai::where('sppd_id', $this->idHapus)->delete();

        $this->showSuccessMessage('Data has been deleted successfully!');

    }

    private function showSuccessMessage($message)
    {
        $this->js(<<<JS
        Swal.fire({
            title: 'Good job!',
            text: '$message',
            icon: 'success',
        })
        JS);
    }

    public function render()
    {
        $sppds = Sppd::with(['pegawai', 'laporannya'])->where('kdunit', auth()->user()->kdunit)->orderBy('tgl_berangkat', 'desc')->paginate(10);

        return view('livewire.sppd.sppd-index', [
            'sppds' => $sppds,
            'kepala' => $this->kepalaDinas
        ]);
    }
}
