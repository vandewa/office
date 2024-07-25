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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

class Sppd extends Component
{
    public $nama, $sppd, $sppdId = null, $edit = false, $readonly = false, $laporan_sppds; // Tambahkan properti ini

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
        // $this->laporan_sppds = LaporanSppd::all();
        $this->sppdId = $id;
        if ($id) {
            $sppd = ModelsSppd::with('laporanSppds')->findOrFail($id);
            $this->laporan_sppds = $sppd->laporanSppds;
        } else {
            $this->laporan_sppds = collect(); // Inisialisasi dengan koleksi kosong
        }
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

    public function generateSpt($sppd)
    {
        // Membuat objek TemplateProcessor
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template_spt.docx');

        $listDasar = $this->formDasar;
        $block_dasar = [];
        $n = 1;
        $dasar = 'dasar';
        $i = ':';

        foreach ($listDasar as $index => $dasarnya) {
            // Menambahkan data ke dalam array blocks
            $block_dasar[] = [
                'dasar' => $dasar,
                'i' => $i,
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

        $user = Auth::user();
        $nip = $user->nip;
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();

        $tanggal = $this->form['ditetapkan_tgl'] ?? now()->format('Y-m-d'); // Menggunakan tanggal saat ini jika tidak ada tanggal di input data

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

        // dd($kepalaDinas);

        // Mengganti placeholder di dalam block_dasar
        $phpWord->cloneBlock('block_dasar', 0, true, false, $block_dasar);
        $phpWord->cloneBlock('block_name', 0, true, false, $block_name);

        // Menentukan nama dokumen
        $namaDokumen = 'SPT_' . date('d_F_Y', strtotime($tanggal)) . '.docx';

        $phpWord->saveAs($namaDokumen);

        // $path = storage_path('app/public/' . $namaDokumen);

        // Simpan dokumen di folder storage
        // $phpWord->saveAs($path);

        // Simpan path dokumen di session
        // session()->put('spt_document_path', $path);
    }

    public function downloadSpt()
    {
        $path = session('spt_document_path');

        dd($path, file_exists($path)); // Debugging

        if ($path && file_exists($path)) {
            return response()->download($path);
        }

        return abort(404, 'Dokumen tidak ditemukan.');
    }

    public function generateSpd($sppd)
    {
        // Definisikan mapping angka ke kata
        $numberToWord = [
            1 => 'satu', 2 => 'dua', 3 => 'tiga', 4 => 'empat',
            5 => 'lima', 6 => 'enam', 7 => 'tujuh', 8 => 'delapan', 9 => 'sembilan',
            10 => 'sepuluh', 11 => 'sebelas', 12 => 'dua belas', 13 => 'tiga belas',
            14 => 'empat belas', 15 => 'lima belas', 16 => 'enam belas', 17 => 'tujuh belas',
            18 => 'delapan belas', 19 => 'sembilan belas', 20 => 'dua puluh'
        ];

        // Ambil pengguna yang sedang login
        $user = Auth::user();
        $nip = $user->nip;
        // Ambil kepala dinas berdasarkan kondisi tertentu
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();
        $tanggal = $this->form['ditetapkan_tgl'] ?? now()->format('Y-m-d');
        $hari = $this->form['hari'] ?? 0;
        $hariDalamKata = $numberToWord[$hari] ?? 'tidak diketahui'; // Mengonversi angka menjadi kata

        // Ambil daftar NIP pegawai dari form
        $nipList = $this->formNama['nip'] ?? [];
        foreach ($nipList as $nip) {
            $pegawai = Tb01::where('nip', $nip)->first();
            if ($pegawai) {
                // Ambil data pegawai
                $nama = $pegawai->nama ?? '';
                $jabatan = '';
                // Cek jabatan pegawai
                $jabfung = Tb01::join('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
                    ->where('tb_01.nip', $nip)
                    ->select('a_jabfung.jabfung')
                    ->first();
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
                // Ambil data golongan
                $golonganData = Tb01::join('a_golruang', 'tb_01.idgolrupkt', '=', 'a_golruang.idgolru')
                    ->where('tb_01.nip', $nip)
                    ->select('a_golruang.golru', 'a_golruang.pangkat')
                    ->first();
                $golongan = $golonganData ? str_replace('\/', '/', $golonganData->golru) : '';
                $pangkat = $golonganData ? $golonganData->pangkat : '';
                // Ambil daftar pengikut dan buat string pengikut dengan nomor urut dan tanggal lahir
                $pengikutList = array_filter($nipList, function ($item) use ($nip) {
                    return $item !== $nip;
                });
                $pengikutStr = '';
                $tglhrStr = '';
                $nStr = '';
                $n = 1;
                foreach ($pengikutList as $pengikut) {
                    $pengikutPegawai = Tb01::where('nip', $pengikut)->first();
                    if ($pengikutPegawai) {
                        $nStr .= $n . ".\n";
                        $pengikutStr .= $pengikutPegawai->nama . "\n";
                        $tglhrStr .= $pengikutPegawai->tglhr . "\n";
                        $n++;
                    }
                }
                // Buat dan simpan dokumen untuk setiap pegawai
                $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template_spd.docx');
                // Set nilai untuk placeholder dalam dokumen
                $values = [
                    'tingkat_id' => strval($this->form['tingkat_id'] ?? ''),
                    'maksud' => strval($this->form['maksud'] ?? ''),
                    'tempat_berangkat' => strval($this->form['tempat_berangkat'] ?? ''),
                    'tempat_tujuan' => strval($this->form['tempat_tujuan'] ?? ''),
                    'hari' => $hariDalamKata,
                    'hari2' => strval($this->form['hari'] ?? ''),
                    'tgl_berangkat' => strval($this->form['tgl_berangkat'] ?? ''),
                    'tgl_kembali' => strval($this->form['tgl_kembali'] ?? ''),
                    'alat_angkut_st' => strval($this->form['alat_angkut_st'] ?? ''),
                    'n' => $nStr,
                    'pengikut' => $pengikutStr,
                    'tglhr' => $tglhrStr,
                    'keterangan' => strval($this->form['keterangan'] ?? ''),
                    'tanggal' => $tanggal,
                    'n_kep' => $kepalaDinas->nama ?? '',
                    'n_pangkat' => $kepalaDinas->pangkat ?? '',
                    'n_nip' => $kepalaDinas->nip ?? '',
                    'nama' => $nama,
                    'nip' => $nip,
                    'pangkat' => $pangkat,
                    'golongan' => $golongan,
                    'jabatan' => $jabatan
                ];
                $phpWord->setValues($values);
                $namaDokumen = 'SPD_' . $nama . '_' . date('d_F_Y', strtotime($tanggal)) . '.docx';
                // Simpan dokumen
                // $phpWord->saveAs($namaDokumen);
                // Simpan dokumen di folder storage
                $path = storage_path('app/public/' . $namaDokumen);
                $phpWord->saveAs($path);

                // Simpan path dokumen di array
                $dokumenPaths[$nip] = $path;
            }
        }
        // Simpan path dokumen ke session atau database untuk digunakan nanti
        session()->put('dokumen_paths', $dokumenPaths);
    }

    public function downloadDokumen($nip)
    {
        $dokumenPaths = session('dokumen_paths', []);
        if (isset($dokumenPaths[$nip])) {
            return response()->download($dokumenPaths[$nip]);
        }

        return abort(404, 'Dokumen tidak ditemukan.');
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
            StatusLaporan::updateOrCreate(
                ['sppd_id' => $sppd->id],
                ['status_laporan' => 'Belum Selesai']
            );
        }

        $this->generateSpt($sppd);
        $this->generateSpd($sppd);

        return redirect()->to('/sppd-index');
    }

    public function submitLaporan()
    {
        $sppd = ModelsSppd::findOrFail($this->sppdId);

        // Simpan input dasar ke tabel laporan_sppd
        LaporanSppd::create([
            'sppd_id' => $sppd->id,
            'laporan_sppd' => $this->formLaporan['laporan_sppd'],
        ]);

        StatusLaporan::updateOrCreate(
            ['sppd_id' => $sppd->id],
            ['status_laporan' => 'Selesai']
        );

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
        return view('livewire.sppd.sppd', [
            'laporan_sppds' => $this->laporan_sppds
        ]);
    }
}
