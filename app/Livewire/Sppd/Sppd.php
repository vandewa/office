<?php

namespace App\Livewire\Sppd;

use Livewire\Component;
use App\Models\DasarSppd;
use App\Models\LaporanSppd;
use App\Models\Simpeg\ASkpd;
use App\Models\Simpeg\Tb01;
use App\Models\SppdPegawai;
use App\Models\Sppd as ModelsSppd;
use App\Models\StatusLaporan;
use App\Models\StatusSurat;
use Illuminate\Support\Facades\Auth;

class Sppd extends Component
{
    public $nama, $sppd, $sppdId = null, $edit = false;

    public $formStatus = [
        'status_laporan' => null
    ];
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

    public $formLaporan = [
        'laporan_sppd' => null
    ];


    public function mount($id = null)
    {
        $this->sppdId = $id;
        if ($id) {
            $this->getEdit($id);
        } else {
            $this->edit = false;
        }
        $nip = Auth::user()->nip;
        if (Auth::check()) {
            $kdunit = Tb01::where('nip', $nip)->value('kdunit');
            $this->nama = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
                ->where('a_skpd.kdunit', $kdunit)
                ->where('idjenkedudupeg', 1)
                ->distinct()
                ->pluck(Tb01::raw("CONCAT(tb_01.gdp, ' ', tb_01.nama, ' ', tb_01.gdb) AS full_name"), 'tb_01.nip')
                ->map(function ($fullName, $nip) {
                    $pegawai = Tb01::where('nip', $nip)->first();
                    return $fullName . ' - ' . $pegawai->skpd->skpd; // Menambahkan nama SKPD ke dalam nama pegawai
                });
        }
    }

    public function getEdit($id)
    {
        $this->edit = true;
        $this->sppd = ModelsSppd::findOrFail($id); // Gunakan ModelsSppd, bukan Sppd
        $this->form = array_intersect_key($this->sppd->toArray(), $this->form);
    }

    // public function statusLaporan()
    // {
    //     $sppd = ModelsSppd::create($this->form);

    //     if ($this->formStatus === true) {
    //         // Simpan data dengan nilai "Belum Selesai"
    //         StatusLaporan::create([
    //             'sppd_id' => $sppd->id,
    //             'status_laporan' => 'Belum Selesai',
    //         ]);
    //     } else {
    //         // Simpan data dengan nilai "Selesai"
    //         StatusLaporan::create([
    //             'sppd_id' => $sppd->id,
    //             'status_laporan' => 'Selesai',
    //         ]);
    //     }
    // }

    public function save()
    {
        if ($this->edit === false) {
            $this->store();
        } else {
            $this->storeUpdate();
        }
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

        // Simpan input dasar ke tabel dasar_sppd
        LaporanSppd::create([
            'sppd_id' => $sppd->id,
            'laporan_sppd' => $this->formLaporan['laporan_sppd']
        ]);

        if ($this->formLaporan['laporan_sppd'] === null) {
            // Simpan data dengan nilai "Belum Selesai"
            StatusLaporan::create([
                'sppd_id' => $sppd->id,
                'status_laporan' => 'Belum Selesai',
            ]);
        } else {
            // Simpan data dengan nilai "Selesai"
            StatusLaporan::create([
                'sppd_id' => $sppd->id,
                'status_laporan' => 'Selesai',
            ]);
        }
        // StatusLaporan::create([
        //     'sppd_id' =>$sppd->id,
        //     'status_laporan' => $this->formStatus['status_laporan']
        // ]);
        return redirect()->to('/sppd-index');
    }

    public function storeUpdate()
    {
        // Temukan data SPPD yang akan diperbarui
        $sppd = ModelsSppd::findOrFail($this->sppdId); // Menggunakan $this->sppdId daripada $this->sppd->id

        // Perbarui data SPPD dengan nilai baru dari formulir yang diedit
        $sppd->update($this->form);

        // Simpan input dasar ke tabel dasar_sppd
        DasarSppd::where('sppd_id', $sppd->id)->update([
            'dasar' => $this->formDasar['dasar']
        ]);

        LaporanSppd::where('sppd_id', $sppd->id)->update([
            'laporan_sppd' => $this->formLaporan['laporan_sppd']
        ]);

        $laporanSppd = $this->formLaporan['laporan_sppd'];

        if ($laporanSppd !== null) {
            // Jika laporan_sppd diisi, maka simpan data dengan nilai "Selesai"
            StatusLaporan::updateOrCreate(
                ['sppd_id' => $sppd->id],
                ['status_laporan' => 'Selesai']
            );
        }


        // Simpan nip dan idskpd dari select nama ke tabel sppd_pegawai
        $nipList = $this->formNama['nip'] ?? []; // Ambil nip dari formNama
        foreach ($nipList as $nip) {
            $pegawai = Tb01::where('nip', $nip)->first(); // Cari data pegawai berdasarkan nip
            if ($pegawai) {
                SppdPegawai::where('sppd_id', $sppd->id)->update([
                    'nip' => $nip,
                    'idskpd' => $pegawai->idskpd
                ]);
            }
        }

        // Reset nilai variabel setelah disimpan
        $this->reset();

        // Redirect ke halaman sppd-index setelah data disimpan
        return redirect()->to('/sppd-index');
    }

    public function render()
    {
        return view('livewire.sppd.sppd');
    }
}
