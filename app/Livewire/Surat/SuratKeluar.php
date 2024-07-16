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
        'tujuan' => null,
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
        $opdList = ASkpd::all();
        foreach ($opdList as $opd) {
            $this->opdOptions[$opd->idskpd] = $opd->skpd;
        }
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

    public function save()
    {
        if ($this->edit === true) {
            $this->storeUpdate();
        } else {
            $this->store();
        }
    }

    public function sendWhatsApp($phone, $message)
    {

        KirimWA::dispatch($phone, $message);
    }

    public function store()
    {
        // $this->validate([
        //     'form.nomor_surat' => 'required|string|max:255',
        //     'form.jenis_surat' => 'required|string|max:255',
        //     'form.tanggal_surat' => 'required|date',
        //     'form.perihal' => 'required|string|max:255',
        //     'form.tujuan' => 'required|string|max:255',
        //     'form.tempat_tujuan' => 'nullable|string|max:255',
        //     'form.pembukaan' => 'nullable|string|max:1000',
        //     'form.isi' => 'required|string|max:2000',
        //     'form.hari' => 'nullable|string|max:50',
        //     'form.tanggal' => 'nullable|date',
        //     'form.pukul_mulai' => 'nullable|string|max:50',
        //     'form.pukul_selesai' => 'nullable|string|max:50',
        //     'form.tempat_acara' => 'nullable|string|max:255',
        //     'form.penutup' => 'nullable|string|max:1000',
        //     // 'document_id' => 'nullable|exists:documents,id',
        // ]);

        // Masukkan document_id ke dalam $form
        // $this->form['document_id'] = $this->document_id;

        $suratkeluar = ModelsSuratKeluar::create($this->form);

        StatusSurat::create([
            'surat_keluar_id' => $suratkeluar->id,
            'status_surat' => 'Perlu Verifikasi Kepala Bidang',
        ]);

        // Kirim pesan WhatsApp setelah laporan disimpan
        $phone = ""; // Nomor telepon untuk status Selesai
        $message = "keluar1"; // ke kadin
        // // $this->sendWhatsApp($phone, $message);

        // Redirect ke halaman suratkeluar-index setelah data disimpan
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
        } elseif (Gate::allows('kepala_bidang', Auth::user())) {
            TindakLanjut::updateOrCreate(
                ['surat_keluar_id' => $suratkeluar->id],
                [
                    'deskripsi' => $this->formTindakLanjut['deskripsi'],
                    'revisi' => $this->formTindakLanjut['revisi'],
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip,
                ]
            );

            $status = $this->formTindakLanjut['revisi'] ? 'Sekretariat' : 'Perlu Verifikasi Kepala Dinas';

            StatusSurat::updateOrCreate(
                ['surat_keluar_id' => $suratkeluar->id],
                ['status_surat' => $status]
            );
        } elseif (Gate::allows('kepala_dinas', Auth::user())) {
            TindakLanjut::updateOrCreate(
                ['surat_keluar_id' => $suratkeluar->id],
                [
                    'deskripsi' => $this->formTindakLanjut['deskripsi'],
                    'revisi' => $this->formTindakLanjut['revisi'],
                    'metode_ttd' => $this->formTindakLanjut['metode_ttd'],
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip
                ]
            );

            StatusSurat::updateOrCreate(
                ['surat_keluar_id' => $suratkeluar->id],
                ['status_surat' => 'Sekretariat']
            );
        }

        // Reset variabel setelah disimpan
        $this->reset();

        // Redirect ke halaman suratkeluar-index setelah data disimpan
        return redirect()->to('/suratkeluar-index');
    }


    public function distribusikan()
    {
        if (Gate::allows('sekretariat', Auth::user())) {
            $statusSurat = StatusSurat::where('surat_keluar_id', $this->suratkeluar->id)->first();

            if ($statusSurat) {
                // Update status if the current status is 'Sekretariat'
                if ($statusSurat->status_surat === 'Sekretariat') {
                    $statusSurat->update([
                        'status_surat' => 'Sudah Distribusikan',
                    ]);

                    // Send WhatsApp message after status is updated
                    $phone = ""; // Phone number for status Selesai
                    $message = "k4"; // Message to all staff
                    // $this->sendWhatsApp($phone, $message);
                }
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
        $surat = ModelsSuratKeluar::with('document')->find($this->suratkeluarId);
        return view('livewire.surat.surat-keluar', [
            'surat' => $surat,
            'skpd' => $this->skpd,
            'nama' => $this->nama,
            'tindakLanjut' => $this->tindakLanjut,
        ]);
    }
}
