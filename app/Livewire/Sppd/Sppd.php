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
        $this->sppdId = $id;
        $this->readonly = request()->routeIs('sppd-laporan'); // Tentukan readonly berdasarkan route
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
        $this->formDasar[] = '';
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
    }

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
        foreach ($this->formDasar as $dasar) {
            DasarSppd::create([
                'sppd_id' => $sppd->id,
                'dasar' => $dasar
            ]);
        }

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

        // Generate and save the document
        $this->generateSpt($sppd);

        return redirect()->to('/sppd-index');
    }

    public function generateSpt($sppd)
    {
        // Membuat objek TemplateProcessor
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template1.docx');


        // Mengambil data dari database dan membentuk string
        $listDasar = $this->formDasar;
        $block_dasar = [];
        $n = 1;

        foreach ($listDasar as $index => $dasarnya) {
            // Menambahkan data ke dalam array blocks
            $block_dasar[] = [
                'dasar' => $index == 0 ? 'Dasar' : '', // Hanya mengatur 'Dasar' untuk iterasi pertama
                'i' => $index == 0 ? ':' : '', // Hanya mengatur ':' untuk iterasi pertama
                'n' => $n++, // Nomor urut
                'dasarnya' => $dasarnya // Isi dasar
            ];
        }

        $nipList = $this->formNama['nip'] ?? [];
        $block_name = []; // Array to hold the data for the repeating block

        foreach ($nipList as $index => $nip) {
            $pegawai = Tb01::where('nip', $nip)->first();
            if ($pegawai) {
                $gdp = $pegawai->gdp ?? '';
                $nama = $pegawai->nama ?? '';
                $gdb = $pegawai->gdb ?? '';
                $nip = $pegawai->nip ?? '';
                $jabatan = '';

                // Cek apakah pegawai memiliki jabfung
                $jabfung = Tb01::join('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
                    ->where('tb_01.nip', $nip)
                    ->select('a_jabfung.jabfung')
                    ->first();

                // Jika pegawai tidak memiliki jabfung, coba cari jabfungum
                if ($jabfung) {
                    $jabatan = $jabfung->jabfung;
                } else {
                    $jabfungum = Tb01::join('a_jabfungum', 'tb_01.idjabfungum', '=', 'a_jabfungum.idjabfungum')
                        ->where('tb_01.nip', $nip)
                        ->select('a_jabfungum.jabfungum')
                        ->first();

                    if ($jabfungum) {
                        $jabatan = $jabfungum->jabfungum;
                    } else {
                        $jabjbt = Tb01::join('a_skpd', 'tb_01.idjabjbt', '=', 'a_skpd.idskpd')
                            ->where('tb_01.nip', $nip)
                            ->select('a_skpd.jab')
                            ->first();

                        if ($jabjbt) {
                            $jabatan = $jabjbt->jab;
                        }
                    }
                }

                $golonganData = Tb01::join('a_golruang', 'tb_01.idgolrupkt', '=', 'a_golruang.idgolru')
                    ->where('tb_01.nip', $nip)
                    ->select('a_golruang.golru', 'a_golruang.pangkat')
                    ->first();
                $golongan = $golonganData ? str_replace('\/', '/', $golonganData->golru) : '';
                $pangkat = $golonganData ? $golonganData->pangkat : '';
                // Add the data to the block
                $block_name[] = [
                    'kepada' => $index == 0 ? 'Kepada' : '',
                    'o' => $index + 1,
                    'i2' => $index == 0 ? ':' : '',
                    'nama' => $gdp . ' ' . $nama . ' ' . $gdb,
                    'nip' => $nip,
                    'pangkat' => $pangkat,
                    'golongan' => $golongan,
                    'jabatan' => $jabatan
                ];
            }
        }

        // Mengambil data kepala dinas dari tabel tb_01
        $kepalaDinas = Tb01::where('idskpd', $this->form['kdunit'] ?? '')->first();
        // Mengambil tanggal dari input data
        $tanggal = $this->form['ditetapkan_tgl'] ?? now()->format('Y-m-d'); // Menggunakan tanggal saat ini jika tidak ada tanggal di input data
        // Memastikan data kepala dinas ada sebelum digunakan
        if ($kepalaDinas) {
            // Set nilai untuk placeholder dalam dokumen
            $phpWord->setValues([
                'untuk' => strval($this->form['untuk'] ?? ''),
                'tanggal' => $tanggal,
                'n_kep' => $kepalaDinas->nama ?? '',
                'n_pangkat' => $kepalaDinas->pangkat ?? '',
                'n_nip' => $kepalaDinas->nip ?? ''
            ]);
        }
        // Mengisi block dasar
        $phpWord->cloneBlock('block_dasar', 0, true, false, $block_dasar);
        $phpWord->cloneBlock('block_name', 0, true, false, $block_name);

        // Membuat nama file berdasarkan tanggal
        $namaDokumen = 'SPT_' . date('d F Y', strtotime($tanggal)) . '.docx';

        // $namaDokumenHTML = 'SPT_' . date('d F Y', strtotime($tanggal)) . '.html';
        // Menyimpan dokumen dengan nama yang telah dibuat
        $phpWord->saveAs($namaDokumen);
        // $phpWord->saveAs($namaDokumenHTML);
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


        // Ambil nip yang di-submit dari form
        $nipList = $this->formNama['nip'] ?? []; // Ambil nip dari formNama

        // Dapatkan daftar nip yang sudah ada di database untuk sppd_id yang spesifik
        $existingNips = SppdPegawai::where('sppd_id', $sppd->id)->pluck('nip')->toArray();

        // Cari nip yang perlu ditambahkan dan yang perlu dihapus
        $nipsToAdd = array_diff($nipList, $existingNips);
        $nipsToRemove = array_diff($existingNips, $nipList);

        // Tambahkan nip baru yang tidak ada di database
        foreach ($nipsToAdd as $nip) {
            $pegawai = Tb01::where('nip', $nip)->first(); // Cari data pegawai berdasarkan nip
            if ($pegawai) {
                SppdPegawai::create([
                    'sppd_id' => $sppd->id,
                    'nip' => $nip,
                    'idskpd' => $pegawai->idskpd
                ]);
            }
        }

        // Hapus nip yang tidak lagi ada di form
        SppdPegawai::where('sppd_id', $sppd->id)->whereIn('nip', $nipsToRemove)->delete();

        // Update nip yang ada di database
        foreach ($nipList as $nip) {
            $pegawai = Tb01::where('nip', $nip)->first(); // Cari data pegawai berdasarkan nip
            if ($pegawai) {
                SppdPegawai::where('sppd_id', $sppd->id)->where('nip', $nip)->update([
                    'idskpd' => $pegawai->idskpd
                ]);
            }
        }

        // Reset nilai variabel setelah disimpan
        $this->reset();

        // Generate and save the document
        $this->generateSpt($sppd);

        // Redirect ke halaman sppd-index setelah data disimpan
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
