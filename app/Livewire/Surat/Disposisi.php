<?php

namespace App\Livewire\Surat;

use App\Models\DisposisiSuratMasuk;
use App\Models\SuratMasuk;
use Livewire\Component;
use App\Models\Simpeg\Tb01;
use Illuminate\Support\Facades\DB;

class Disposisi extends Component
{
    public $idnya, $pegawai, $disposisi, $cc, $idHapus, $statusDisposisi;

    public $form = [
        'surat_masuks_id' => null,
        'keterangan' => null,
        'disposisi_tp' => null,
        'created_by' => null,
        'tujuan_user_id' => null,
    ];
    public function updatedStatusDisposisi()
    {
        $this->js(<<<'JS'
           $('.select-search').select2();
           $('.select-search').select2();           
        JS);
    }
    public function mount($id)
    {
        $this->idnya = $id;

        $this->pegawai = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
            ->where('a_skpd.kdunit', auth()->user()->kdunit)
            ->where('idjenkedudupeg', 1)
            ->groupBy('tb_01.nip', 'tb_01.nama', 'tb_01.gdb', 'tb_01.gdp')
            ->orderBy('tb_01.nama', 'asc')
            ->pluck(DB::raw("CONCAT(
                IF(tb_01.gdp IS NOT NULL AND tb_01.gdp != '', CONCAT(tb_01.gdp, ' '), ''),
                tb_01.nama,
                IF(tb_01.gdb IS NOT NULL AND tb_01.gdb != '', CONCAT(', ', tb_01.gdb), '')
            ) as nama_gdb"), 'tb_01.nip');
    }

    public function save()
    {
        $this->form['surat_masuks_id'] = $this->idnya;
        $this->form['created_by'] = auth()->user()->nip;

        foreach ($this->disposisi as $list) {
            //jika pegawai sebagai disposisi
            $this->form['disposisi_tp'] = 'DISPOSISI_TP_01';
            $this->form['tujuan_user_id'] = $list;
            DisposisiSuratMasuk::create($this->form);
        }

        foreach ($this->cc as $list) {
            //jika pegawai sebagai disposisi
            $this->form['disposisi_tp'] = 'DISPOSISI_TP_02';
            $this->form['tujuan_user_id'] = $list;
            DisposisiSuratMasuk::create($this->form);
        }

        $this->showSuccessMessage('Berhasil disposisi surat!');
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
        DisposisiSuratMasuk::destroy($this->idHapus);

        $this->showDeleteMessage('Data has been deleted successfully!');
    }

    private function showDeleteMessage($message)
    {
        $this->js(<<<JS
        Swal.fire({
            title: 'Good job!',
            text: '$message',
            icon: 'success',
        })
        JS);
    }

    private function showSuccessMessage($message)
    {
        $this->js(<<<JS
            Swal.fire({
                title: 'Berhasil!',
                text: '$message',
                icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/surat-masuk-index'; // Ganti '/sppd-index' dengan route yang benar
                }
            });
        JS);
    }

    public function updated($property)
    {
        // if ($property == 'statusYa' || $property == 'statusTidak') {
        //     if ($this->statusYa == 'on') {
        //         $this->statusTidak = null;
        //     }
        //     if ($this->statusTidak == 'on') {
        //         $this->statusYa = null;
        //     }
        // }
    }

    public function render()
    {
        $disposisi = DisposisiSuratMasuk::where('surat_masuks_id', $this->idnya)->where('disposisi_tp', 'DISPOSISI_TP_01')->get();

        $cc = DisposisiSuratMasuk::where('surat_masuks_id', $this->idnya)->where('disposisi_tp', 'DISPOSISI_TP_02')->get();

        $keterangan = DisposisiSuratMasuk::where('surat_masuks_id', $this->idnya)->first();

        $kumpulanPegawaiDisposisi = [];
        foreach ($disposisi as $list) {
            $kumpulanPegawaiDisposisi[] = $list->tujuan_user_id;
        }

        $kumpulanPegawaiCC = [];
        foreach ($cc as $list) {
            $kumpulanPegawaiCC[] = $list->tujuan_user_id;
        }

        $cekPegawaiDisposisi = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
            when jabfung is null then jabfungum
            else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->whereIn('nip', $kumpulanPegawaiDisposisi)
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->get();

        $cekPegawaiCc = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("case when jabfung is null and jabfungum is null then jabatan.jab
            when jabfung is null then jabfungum
            else  jabfung end as jabatan"), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->whereIn('nip', $kumpulanPegawaiCC)
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->get();

        // Gabungkan ID dari DisposisiSuratMasuk dengan hasil Tb01
        $mergedDataCC = $cekPegawaiCc->map(function ($item) use ($cc) {
            $disposisi = $cc->firstWhere('tujuan_user_id', $item->nip); // Mencari disposisi yang cocok
            $item->disposisi_id = $disposisi ? $disposisi->id : null; // Menambahkan ID Disposisi ke hasil Tb01
            return $item;
        });

        // Gabungkan ID dari DisposisiSuratMasuk dengan hasil Tb01
        $mergedDataDisposisi = $cekPegawaiDisposisi->map(function ($item) use ($disposisi) {
            $disposisi = $disposisi->firstWhere('tujuan_user_id', $item->nip); // Mencari disposisi yang cocok
            $item->disposisi_id = $disposisi ? $disposisi->id : null; // Menambahkan ID Disposisi ke hasil Tb01
            return $item;
        });

        $logSurat = SuratMasuk::with(['disposisi', 'disposisi.dari', 'disposisi.untuk'])->find($this->idnya);
        // $b = route('helper.show-picture', ['path' => $logSurat->path_surat]);
        $b = asset('aa.pdf');
        // dd($b);
        $this->dispatch('surat', ['path' => $b]);
        // dd($keterangan);

        return view('livewire.surat.disposisi', [
            'cekPegawaiDisposisi' => $mergedDataDisposisi,
            'cekPegawaiCc' => $mergedDataCC,
            'keterangan' => $keterangan,
            'logSurat' => $logSurat
        ]);
    }
}
