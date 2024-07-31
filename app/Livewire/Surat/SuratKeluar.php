<?php

namespace App\Livewire\Surat;

use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\Simpeg\Tb01;
use App\Models\Document;
use App\Models\StatusSurat;
use App\Models\Simpeg\ASkpd;
use App\Models\TindakLanjut;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\SuratKeluar as ModelsSuratKeluar;

class SuratKeluar extends Component
{
    use WithFileUploads;

    public $suratkeluar, $skpd, $nama,  $opdOptions = [], $tindakLanjut, $edit = false, $suratkeluarId = null, $readonly = false;
    public $document_id, $document;

    public $form = [
        'nomor_surat'  => null,
        'jenis_surat' => null,
        'tanggal_surat' => null,
        'perihal' => null,
        'opd_id' => null,
        'tempat_tujuan' => null,
        'pembukaan' => null,
        'isi' => null,
        'hari' => null,
        'tanggal' => null,
        'pukul_mulai' => null,
        'pukul_selesai' => null,
        'tempat_acara' => null,
        'penutup' => null,
        // 'lampiran' => null,
    ];

    public $formTindakLanjut  = [
        'deskripsi' => null,
        'nama' => null,
        'nip' => null,
        'diteruskan_kepada' => [],
        'disposisi' => [],
        'revisi' => null,
        'metode_ttd' => null
    ];

    public $formStatusSurat = [
        'status_surat' => null
    ];

    public function mount($id = null)
    {
        $this->document_id = session('document_id');
        $this->suratkeluar = $id;
        $this->readonly = request()->routeIs('suratkeluar-verifikasi');
        $this->tindakLanjut = TindakLanjut::where('surat_keluar_id', $id)->first();
        // Ambil data OPD dari database dan susun ke dalam array untuk opsi dropdown
        $this->opdOptions = ASkpd::pluck('skpd', 'idskpd')->toArray();

        // dd($this->opdOptions);
        $this->suratkeluarId = $id;
        if ($id) {
            $this->getEdit($id);
        } else {
            $this->edit = false;
        }
        if (Auth::check()) {
            $nip = Auth::user()->nip;
            $kdunit = Tb01::where('nip', $nip)->value('kdunit');
            $idskpd = Tb01::where('nip', $nip)->value('idskpd');
            $this->skpd = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
                ->where('a_skpd.kdunit', $kdunit)
                ->where('idjenkedudupeg', 1)
                ->whereColumn('tb_01.idjabjbt', 'tb_01.idskpd')
                ->distinct()
                ->pluck('a_skpd.skpd', 'tb_01.nip')
                ->map(function ($skpd, $nip) {
                    $pegawai = Tb01::where('nip', $nip)->first();
                    return $pegawai->skpd->skpd; // Menambahkan nama SKPD ke dalam nama pegawai
                });
        }
        // Kondisi untuk Kepala Bidang
        if (Gate::allows('kepala_bidang', Auth::user())) {
            $this->nama = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
                ->where('tb_01.idskpd', $idskpd)
                ->where('idjenkedudupeg', 1)
                ->distinct()
                ->pluck(Tb01::raw("CONCAT(tb_01.gdp, ' ', tb_01.nama, ' ', tb_01.gdb) AS full_name"), 'tb_01.nip')
                ->map(function ($fullName, $nip) {
                    $pegawai = Tb01::where('nip', $nip)->first();
                    return $fullName . ' - ' . $pegawai->skpd->skpd;
                });
        }
    }

    public function getEdit($id)
    {
        $this->edit = true;
        $this->suratkeluar = ModelsSuratKeluar::findOrFail($id);
        $this->form = array_intersect_key($this->suratkeluar->toArray(), $this->form);
    }

    public function sendWhatsapp()
    {
        $user = Auth::user();
        $nip = $user->nip;
        $kdunit = Tb01::where('nip', $nip)->value('kdunit');

        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->pluck('hp'); // Mengambil hanya kolom 'hp'

        $kepalaBidang = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
            ->where('a_skpd.kdunit', $kdunit)
            ->where('idjenkedudupeg', 1)
            ->where('idjabjbt', '=', $user->idskpd)
            ->pluck('tb_01.hp'); // Mengambil hanya kolom 'hp'

        $staff = Tb01::where('kdunit', $user->kdunit)
            ->where('idjenkedudupeg', 1)
            ->pluck('tb_01.hp'); // Mengambil hanya kolom 'hp'

        $sekretariat = Tb01::from('tb_01 as tb')
            ->join('a_skpd as skpd', 'tb.kdunit', '=', 'skpd.kdunit')
            ->where('idjenkedudupeg', 1)
            ->where(function ($query) use ($user) {
                $query->where('tb.idskpd', $user->kdunit . '.01')
                    ->orWhere(function ($query) use ($user) {
                        $query->where('tb.idskpd', 'like', $user->kdunit . '.01.%')
                            ->whereRaw('LENGTH(tb.idskpd) = ?', [strlen($user->kdunit . '.01') + 3]); // Exact length match
                    });
            })
            ->distinct()
            ->pluck('tb.hp'); // Mengambil hanya kolom 'hp'

        $pesan_sekre = 'Surat masuk perlu ditindaklanjuti Kepala Dinas';
        $pesan_kadin = 'Surat masuk perlu ditindaklanjuti Kepala Bidang';
        $pesan_kabid = 'Surat masuk sudah ditindaklanjuti Kepala Dinas dan Kepala Bidang';
        $pesan_revisi = 'Ada revisi surat masuk';
        $pesan_distribusikan = 'Silakan cek surat masuk terbaru';
    }

    public function generateSuratKeluar($suratkeluarId)
    {
        $suratkeluar = ModelsSuratKeluar::findOrFail($suratkeluarId);
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template_suratkeluar.docx');

        $user = Auth::user();
        $nip = $user->nip;
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();

        $values = [
            'nomor_surat' => strval($this->form['nomor_surat'] ?? ''),
            'perihal' => strval($this->form['perihal'] ?? ''),
            'opd_id' => strval($this->form['opd_id'] ?? ''),
            'tempat_tujuan' => strval($this->form['tempat_tujuan'] ?? ''),
            'pembukaan' => strval($this->form['pembukaan'] ?? ''),
            'isi' => strval($this->form['isi'] ?? ''),
            'hari' => strval($this->form['hari'] ?? ''),
            'tanggal' => strval($this->form['tanggal'] ?? ''),
            'pukul_mulai' => strval($this->form['pukul_mulai'] ?? ''),
            'pukul_selesai' => strval($this->form['pukul_selesai'] ?? ''),
            'tempat_acara' => strval($this->form['tempat_acara'] ?? ''),
            'penutup' => strval($this->form['penutup'] ?? ''),
            'tanggal' => strval($this->form['tanggal'] ?? ''),
            'n_kep' => $kepalaDinas->nama ?? '',
            'n_pangkat' => $kepalaDinas->pangkat ?? '',
            'n_nip' => $kepalaDinas->nip ?? ''
        ];
        $phpWord->setValues($values);
        $nomorSurat = !empty($values['nomor_surat']) ? $values['nomor_surat'] : 'NomorSuratUndefined';
        $namaDokumen = 'Surat Keluar - ' . $nomorSurat . '.docx';

        $path = storage_path('app/public/' . $namaDokumen);
        $phpWord->saveAs($path);

        // Simpan jalur file di tabel documents
        $document = Document::create([
            'dok_surat' => $namaDokumen,
            'surat_keluar_id' => $suratkeluarId,
        ]);

        // Update kolom document_id di tabel surat_keluars
        $suratkeluar->update(['document_id' => $document->id]);
    }

    public function save()
    {
        if (Gate::allows('sekretariat', Auth::user())) {
            if ($this->edit === true) {
                $this->storeUpdate();
            } else {
                $this->store();
            }
        }

        if (Gate::allows('kepala_dinas', Auth::user())) {
            $this->storeKadin();
        }

        if (Gate::allows('kepala_bidang', Auth::user())) {
            $this->storeKabid();
        }
    }

    public function store()
    {

        $suratkeluar = ModelsSuratKeluar::create($this->form);

        StatusSurat::create([
            'surat_keluar_id' => $suratkeluar->id,
            'status_surat' => 'Perlu Verifikasi Kepala Bidang',
        ]);
        $this->generateSuratKeluar($suratkeluar->id);
        return redirect()->to('/suratkeluar-index');
    }

    public function storeKabid()
    {
        $suratkeluar = ModelsSuratKeluar::findOrFail($this->suratkeluarId);

        TindakLanjut::updateOrCreate([
            'surat_keluar_id' => $suratkeluar->id,
            'deskripsi' => $this->formTindakLanjut['deskripsi'],
            // 'disposisi' => $disposisi,
            // 'diteruskan_kepada' => null,
            'revisi' => $this->formTindakLanjut['revisi'] === 'revisi' ? true : false,
            'nama' => Auth::user()->nama,
            'nip' => Auth::user()->nip
        ]);

        $statusSurat = $this->formTindakLanjut['revisi'] === 'revisi' ? 'Revisi' : 'Perlu Verifikasi Kepala Dinas';

        StatusSurat::updateOrCreate(
            ['surat_keluar_id' => $suratkeluar->id],
            ['status_surat' => $statusSurat]
        );

        return redirect()->to('/suratkeluar-index');
    }

    public function storeKadin()
    {
        $suratkeluar = ModelsSuratKeluar::findOrFail($this->suratkeluarId);
        TindakLanjut::updateOrCreate(
            ['surat_keluar_id' => $suratkeluar->id],
            [
                'deskripsi' => $this->formTindakLanjut['deskripsi'],
                'revisi' => $this->formTindakLanjut['revisi'] === 'revisi' ? true : false,
                'metode_ttd' => $this->formTindakLanjut['metode_ttd'],
                'nama' => Auth::user()->nama,
                'nip' => Auth::user()->nip
            ]
        );
        $statusSurat = $this->formTindakLanjut['revisi'] === 'revisi' ? 'Revisi' : 'Sekretariat';

        StatusSurat::updateOrCreate(
            ['surat_keluar_id' => $suratkeluar->id],
            ['status_surat' => $statusSurat]
        );
        return redirect()->to('/suratkeluar-index');
    }

    public function storeUpdate()
    {
        $suratkeluar = ModelsSuratKeluar::findOrFail($this->suratkeluarId);

        if (Gate::allows('sekretariat', Auth::user())) {
            $suratkeluar->update($this->form);

            // Update atau buat status surat
            StatusSurat::updateOrCreate(
                ['surat_keluar_id' => $suratkeluar->id],
                ['status_surat' => 'Perlu Verifikasi Kepala Bidang']
            );
        }

        // Reset variabel setelah disimpan
        $this->reset();

        // Redirect ke halaman suratkeluar-index setelah data disimpan
        return redirect()->to('/suratkeluar-index');
    }

    public function distribusikan()
    {
        $statusSurat = StatusSurat::where('surat_keluar_id', $this->suratkeluar->id)->first();
        if ($statusSurat) {
            // Update status if the current status is 'Sekretariat'
            if ($statusSurat->status_surat === 'Sekretariat') {
                $statusSurat->update([
                    'status_surat' => 'Sudah Distribusikan',
                ]);
            }
        }
        // Redirect ke halaman suratkeluar-index setelah data disimpan
        return redirect()->to('/suratkeluar-index');
    }

    public function getIsReadonlyProperty()
    {
        return $this->readonly;
    }

    public function getSuratKeluar($id)
    {
        return view('livewire.surat.print-suratkeluar');
        // $surat1 = SuratKeluar::where('surat_keluar_id', $this->suratkeluar->id)->first();
        // return view('surat.keluar.print-suratkeluar', compact('surat1'));
    }

    public function render()
    {
        $surat = ModelsSuratKeluar::with('documents')->find($this->suratkeluarId);
        return view('livewire.surat.surat-keluar', [
            'surat' => $surat,
            'skpd' => $this->skpd,
            'nama' => $this->nama,
            'tindakLanjut' => $this->tindakLanjut,
        ]);
    }
}
