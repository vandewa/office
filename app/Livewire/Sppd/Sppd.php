<?php

namespace App\Livewire\Sppd;

use Livewire\Component;
use App\Models\DasarSppd;
use App\Models\Simpeg\Tb01;
use App\Models\SppdPegawai;
use App\Models\Sppd as ModelsSppd;
use Illuminate\Support\Facades\Auth;

class Sppd extends Component
{
    public $nama, $sppd;
    public $edit = false;
    public $formDasar = [
        'dasar' => null
    ];
    public $formNama = [
        'nip' => null
    ];
    public $form = [
        'maksud' => null,
        'untuk' => null,
        'tingkat_id' => null,
        'alat_angkut_st' => null,
        'tempat_berangkat' => null,
        'tempat_tujuan' => null,
        'tgl_berangkat' => null,
        'tgl_kembali' => null,
        'hari' => null,
        'ditetapkan_tgl' => null,
        'pengikut' => null,
        'keterangan' => null,
    ];

    public function mount()
    {
        //menampilkan nama di form select nama pegawai
        $nip = Auth::user()->nip;
        if (Auth::check()) {
            $kdunit = Tb01::where('nip', $nip)->value('kdunit');
            $this->nama = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
                ->where('a_skpd.kdunit', $kdunit)
                ->where('idjenkedudupeg', 1)
                ->distinct('tb_01.nama')
                ->pluck('tb_01.nama', 'tb_01.nip');
        }
    }

    public function save()
    {
        $this->store();
    }

    public function store()
    {
        //simpan input form ke tabel sppd
        $sppd = ModelsSppd::create($this->form);

        // Simpan input dasar ke tabel dasar_sppd
        DasarSppd::create([
            'sppd_id' => $sppd->id,
            'dasar' => $this->formDasar['dasar']
        ]);

        // Simpan nip dan idskpd dari select nama ke tabel sppd_pegawai
        $nipList = $this->formNama['nip'] ?? []; // Ambil nip dari formNama
        foreach ($nipList as $nip) {
            $pegawai = Tb01::where('nip', $nip)->first(); // Cari data pegawai berdasarkan nip
            if ($pegawai) {
                SppdPegawai::create([
                    'sppd_id' => $sppd->id,
                    'nip' => $nip,
                    'idskpd' => $pegawai->idskpd
                ]);
            }
        }
        return redirect()->to('/sppd-index');
    }

    public function render()
    {
        return view('livewire.sppd.sppd');
    }
}
