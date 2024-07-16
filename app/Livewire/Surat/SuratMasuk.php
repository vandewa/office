<?php

namespace App\Livewire\Surat;

use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\Document;
use App\Models\Simpeg\Tb01;
use App\Models\StatusSurat;
use App\Models\Simpeg\ASkpd;
use App\Models\TindakLanjut;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\SuratMasuk as ModelsSuratMasuk;

class SuratMasuk extends Component
{
    use WithFileUploads;

    public $nama, $suratmasuk, $opdOptions = [], $suratmasukId = null, $edit = false, $readonly = false, $skpd, $tindakLanjut, $document_id, $document;

    public $form = [
        'jenis_agenda_tp' => null,
        'kode_lama' => null,
        'kode_baru' => null,
        'nomor_surat' => null,
        'opd_id' => null,
        'tgl_surat' => null,
        'tgl_terima' => null,
        'acara' => null,
        'tanggalBerangkat' => null,
        'tanggalPulang' => null,
        'jamMulai' => null,
        'tempat' => null,
        'perihal' => null,

    ];

    public $formTindakLanjut  = [
        'deskripsi' => null,
        'nama' => null,
        'nip' => null,
        'diteruskan_kepada' => [],
        'disposisi' => [],
        'revisi' => null
    ];

    public $formStatusSurat = [
        'status_surat' => null
    ];

    public function mount($id = null)
    {
        $this->document_id = session('document_id');
        $this->suratmasuk = $id;
        $this->tindakLanjut = TindakLanjut::where('surat_masuk_id', $id)->first();
        $this->readonly = request()->routeIs('suratmasuk-disposisi'); // Tentukan readonly berdasarkan route
        // Ambil data OPD dari database dan susun ke dalam array untuk opsi dropdown
        $opdList = ASkpd::all();
        foreach ($opdList as $opd) {
            $this->opdOptions[$opd->idskpd] = $opd->skpd;
        }
        $this->suratmasukId = $id;
        if ($id) {
            $this->getEdit($id);
        } else {
            $this->edit = false;
        }
        if (Auth::check()) {
            $nip = Auth::user()->nip;
            $kdunit = Tb01::where('nip', $nip)->value('kdunit');
            $idskpd = Tb01::where('nip', $nip)->value('idskpd');
            if (Gate::allows('kepala_dinas', Auth::user())) {
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
    }

    public function getEdit($id)
    {
        $this->edit = true;
        $this->suratmasuk = ModelsSuratMasuk::findOrFail($id);
        $this->form = array_intersect_key($this->suratmasuk->toArray(), $this->form);
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
        $this->validate([
            // 'form.jenis_agenda_tp' => 'required|in:JENIS_SURAT_TP_01,JENIS_SURAT_TP_02',
            'form.kode_lama' => 'nullable|string',
            'form.kode_baru' => 'nullable|string',
            'form.nomor_surat' => 'nullable|string',
            'form.opd_id' => 'nullable|string',
            'form.tgl_surat' => 'nullable|date',
            'form.tgl_terima' => 'nullable|date',
            'form.acara' => 'nullable|string',
            'form.tanggalBerangkat' => 'nullable|date',
            'form.tanggalPulang' => 'nullable|date',
            'form.jamMulai' => 'nullable|time',
            'form.tempat' => 'nullable|string',
            'form.perihal' => 'nullable|string',
            'document_id' => 'required|exists:documents,id',
        ]);

        // Masukkan document_id ke dalam $form
        $this->form['document_id'] = $this->document_id;

        // Buat entri SuratMasuk yang baru
        $suratmasuk = ModelsSuratMasuk::create($this->form);

        // Buat entri status surat baru dengan status 'Verifikasi Kepala Dinas'
        StatusSurat::create([
            'surat_masuk_id' => $suratmasuk->id,
            'status_surat' => 'Perlu Verifikasi Kepala Dinas',
        ]);

        // Kirim pesan WhatsApp setelah laporan disimpan
        $phone = ""; // Nomor telepon kepala dinas
        $message = "Pesan WhatsApp Kepada Kepala Dinas untuk Memberikan komentar dan disposisi"; // ke kadin
        // $this->sendWhatsApp($phone, $message);

        // Redirect ke halaman suratmasuk-index setelah data disimpan
        return redirect()->to('/suratmasuk-index');
    }

    public function storeUpdate()
    {
        // dd($this->formTindakLanjut);

        $suratmasuk = ModelsSuratMasuk::findOrFail($this->suratmasukId);

        if (Gate::allows('sekretariat', Auth::user())) {
            // Update kolom lainnya
            $suratmasuk->update([
                'jenis_agenda_tp' => $this->form['jenis_agenda_tp'],
                'kode_lama' => $this->form['kode_lama'],
                'kode_baru' => $this->form['kode_baru'],
                'nomor_surat' => $this->form['nomor_surat'],
                'opd_id' => $this->form['opd_id'],
                'tgl_surat' => $this->form['tgl_surat'],
                'tgl_terima' => $this->form['tgl_terima'],
                'acara' => $this->form['acara'],
                'tanggalBerangkat' => $this->form['tanggalBerangkat'],
                'tanggalPulang' => $this->form['tanggalPulang'],
                'jamMulai' => $this->form['jamMulai'],
                'tempat' => $this->form['tempat'],
                'perihal' => $this->form['perihal'],
                'dok_surat' => isset($path) ? $path : $suratmasuk->dok_surat
            ]);
            // Buat entri status surat baru dengan status 'Verifikasi Kepala Dinas'
            StatusSurat::updateOrCreate([
                'surat_masuk_id' => $suratmasuk->id,
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
            ]);
            // Kirim pesan WhatsApp setelah laporan disimpan
            $phone = ""; // Nomor telepon untuk status Selesai
            $message = "Pesan WhatsApp Kepada Kepala Dinas untuk Memberikan komentar dan disposisi"; // ke kadin
            $this->sendWhatsApp($phone, $message);

        } elseif (Gate::allows('kepala_dinas', Auth::user())) {
            // dd($this->formTindakLanjut);
            // Create or update tindak lanjut records for Kepala Dinas without deleting existing ones
            foreach ($this->formTindakLanjut['diteruskan_kepada'] as $diteruskan_kepada) {
                TindakLanjut::updateOrCreate([
                    'surat_masuk_id' => $suratmasuk->id,
                    'deskripsi' => $this->formTindakLanjut['deskripsi'],
                    'diteruskan_kepada' => $diteruskan_kepada,
                    'revisi' => $this->formTindakLanjut['revisi'],
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip
                ]);
            }

            // dd('Data disimpan untuk Kepala Dinas');
            if ($this->formTindakLanjut['revisi']) {
                $statusSurat = StatusSurat::where('surat_masuk_id', $suratmasuk->id)->first();
                $statusSurat->update([
                    'status_surat' => 'Sekretariat',
                ]);
                // Kirim pesan WhatsApp setelah laporan disimpan
                $phone = ""; // Nomor telepon untuk status Selesai
                $message = "Pesan WhatsApp Kepada Sekretariat untuk Revisi"; // ke kadin
                // $this->sendWhatsApp($phone, $message);

            } else {
                $statusSurat = StatusSurat::where('surat_masuk_id', $suratmasuk->id)->first();
                $statusSurat->update([
                    'status_surat' => 'Perlu Verifikasi Kepala Bidang',
                ]);
                // Kirim pesan WhatsApp setelah laporan disimpan
                $phone = ""; // Nomor telepon untuk status Selesai
                $message = "Pesan WhatsApp Kepada Kepala Bidang untuk Memberikan komentar dan disposisi"; // ke kabid
                $this->sendWhatsApp($phone, $message);
            }
        } elseif (Gate::allows('kepala_bidang', Auth::user())) {
            // Create or update tindak lanjut records for Kepala Bidang without deleting existing ones
            foreach ($this->formTindakLanjut['disposisi'] as $disposisi) {
                TindakLanjut::updateOrCreate([
                    'surat_masuk_id' => $suratmasuk->id,
                    'disposisi' => $disposisi,
                    'revisi' => $this->formTindakLanjut['revisi'],
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip
                ]);
            }
            if ($this->formTindakLanjut['revisi']) {
                $statusSurat = StatusSurat::where('surat_masuk_id', $suratmasuk->id)->first();
                $statusSurat->update([
                    'status_surat' => 'Sekretariat',
                ]);
                // Kirim pesan WhatsApp setelah laporan disimpan
                $phone = ""; // Nomor telepon untuk status Selesai
                $message = "Pesan WhatsApp Kepada Sekretariat untuk Revisi"; // ke kadin
                // $this->sendWhatsApp($phone, $message);

            } else {
                $statusSurat = StatusSurat::where('surat_masuk_id', $suratmasuk->id)->first();
                $statusSurat->update([
                    'status_surat' => 'Sekretariat',
                ]);
                // Kirim pesan WhatsApp setelah laporan disimpan
                $phone = ""; // Nomor telepon untuk status Selesai
                $message = "Pesan WhatsApp Kepada Sekretariat untuk Mendeskripsikan Surat"; // ke kabid
                // $this->sendWhatsApp($phone, $message);
            }
        }

        // Reset variabel setelah disimpan
        $this->reset();

        // Redirect ke halaman suratmasuk-index setelah data disimpan
        return redirect()->to('/suratmasuk-index');
    }

    public function distribusikan()
    {
        $statusSurat = StatusSurat::where('surat_masuk_id', $this->suratmasuk->id)->first();

        if ($statusSurat) {
            // Update status if the current status is 'Sekretariat'
            if ($statusSurat->status_surat === 'Sekretariat') {
                $statusSurat->update([
                    'status_surat' => 'Sudah Distribusikan',
                ]);

                // Send WhatsApp message after status is updated
                $phone = ""; // Phone number for status Selesai
                $message = "Ada surat masuk"; // Message to all staff
                // $this->sendWhatsApp($phone, $message);
            }
        }
        // Redirect ke halaman suratmasuk-index setelah data disimpan
        return redirect()->to('/suratmasuk-index');
    }

    public function getIsReadonlyProperty()
    {
        return $this->readonly;
    }

    public function back()
    {
        return redirect()->route('suratmasuk-index');
    }

    public function render()
    {
        $surat = ModelsSuratMasuk::with('document')->find($this->suratmasukId);
        return view('livewire.surat.surat-masuk', [
            'surat' => $surat,
            'skpd' => $this->skpd,
            'nama' => $this->nama,
            'tindakLanjut' => $this->tindakLanjut,
            // 'document' => $this->document
        ]);
    }
}
