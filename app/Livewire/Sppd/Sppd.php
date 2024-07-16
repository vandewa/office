<?php

namespace App\Livewire\Sppd;

use Dompdf\Dompdf;
use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\DasarSppd;
use App\Models\LaporanSppd;
use App\Models\Simpeg\Tb01;
use App\Models\SppdPegawai;
use App\Models\StatusSurat;
use App\Models\Simpeg\ASkpd;
use App\Models\StatusLaporan;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Sppd as ModelsSppd;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

class Sppd extends Component
{
    public $nama, $sppd, $sppdId = null, $edit = false, $readonly = false; // Tambahkan properti ini

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
        // $this->loadSppdData($id);
        $this->readonly = request()->routeIs('sppd-laporan'); // Tentukan readonly berdasarkan route
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

    public function addDasar()
    {
        // $this->formDasar[] = '';
        $this->formDasar[] = ['dasar' => ''];
    }

    public function removeDasar($index)
    {
        unset($this->formDasar[$index]);
        $this->formDasar = array_values($this->formDasar);
    }

    public function getEdit($id)
    {
        $this->edit = true;
        $this->sppd = ModelsSppd::findOrFail($id); // Gunakan ModelsSppd, bukan Sppd
        $this->form = array_intersect_key($this->sppd->toArray(), $this->form);

        // Memuat data dasar_sppd ke dalam $formDasar
        $dasarList = DasarSppd::where('sppd_id', $id)->pluck('dasar')->toArray();
        $this->formDasar = []; // Reset $formDasar
        foreach ($dasarList as $dasar) {
            $this->formDasar[] = ['dasar' => $dasar]; // Isi $formDasar dengan setiap dasar sebagai array
        }

        // Memuat data sppd_pegawai ke dalam $formNama
        $this->formNama['nip'] = SppdPegawai::where('sppd_id', $id)->pluck('nip')->toArray();
    }


    public function save()
    {
        if ($this->edit === false) {
            $this->store();
        } else {
            $this->storeUpdate();
        }
    }

    public function sendWhatsApp($phone, $message)
    {

        KirimWA::dispatch($phone, $message);
    }

    public function store()
    {
        //simpan input form ke tabel sppd
        $sppd = ModelsSppd::create($this->form);
        // Simpan input dasar ke tabel dasar_sppd
        foreach ($this->formDasar as $dasar) {
            DasarSppd::create([
                'sppd_id' => $sppd->id,
                'dasar' => $dasar
            ]);
        }

        // Simpan input dasar ke tabel dasar_sppd
        // foreach ($this->formDasar as $item) {
        //     DasarSppd::create([
        //         'sppd_id' => $sppd->id,
        //         'dasar' => $item['dasar']
        //     ]);
        // }

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
            StatusLaporan::updateOrCreate(
                ['sppd_id' => $sppd->id],
                ['status_laporan' => 'Belum Selesai']
            );
        }

        return redirect()->to('/sppd-index');
    }

    public function submitLaporan()
    {

        $sppd = ModelsSppd::findOrFail($this->sppdId);

        // Simpan input dasar ke tabel dasar_sppd
        LaporanSppd::create([
            'sppd_id' => $sppd->id,
            'laporan_sppd' => $this->formLaporan['laporan_sppd'],
        ]);


        // Kirim pesan WhatsApp setelah laporan disimpan
        $phone = "089603967291"; // Nomor telepon untuk status Selesai
        $message = "Ye selesai. Silakan lihat";
        $this->sendWhatsApp($phone, $message);

        if ($this->formLaporan['laporan_sppd'] != null) {
            // Simpan data dengan nilai "Selesai"
            StatusLaporan::updateOrCreate(
                ['sppd_id' => $sppd->id],
                ['status_laporan' => 'Selesai']
            );
        }

        return redirect()->to('/sppd-index');
    }


    public function storeUpdate()
    {
        // Temukan data SPPD yang akan diperbarui
        $sppd = ModelsSppd::findOrFail($this->sppdId);

        $sppd->update($this->form);

        // Hapus semua dasar yang lama
        DasarSppd::where('sppd_id', $sppd->id)->delete();

        // Simpan input dasar ke tabel dasar_sppd
        foreach ($this->formDasar as $item) {
            DasarSppd::create([
                'sppd_id' => $sppd->id,
                'dasar' => $item['dasar']
            ]);
        }


        // Hapus semua entri sppd_pegawai untuk sppd_id yang bersangkutan
        SppdPegawai::where('sppd_id', $sppd->id)->delete();
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

        StatusLaporan::updateOrCreate(
            ['sppd_id' => $sppd->id],
            ['status_laporan' => 'Belum Selesai']
        );


        return redirect()->to('/sppd-index');
    }

    public function getIsReadonlyProperty()
    {
        return $this->readonly;
    }

    public function render()
    {
        return view('livewire.sppd.sppd');
    }
}
