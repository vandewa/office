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
        'jenis_agenda_tp' => [],
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
        'revisi' =>  null
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
                    //  ->first();
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

    public function sendWhatsapp()
    {
        $user = Auth::user();
        $nip = $user->nip;
        $kdunit = Tb01::where('nip', $nip)->value('kdunit');

        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->select('tb_01.hp') // Memilih kolom yang relevan
            ->get();

            dd($kepalaDinas);

        $kepalaBidang = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
            ->where('a_skpd.kdunit', $kdunit)
            ->where('idjenkedudupeg', 1)
            ->where('idjabjbt', '=', $user->idskpd)
            ->select('tb_01.hp', 'tb_01.kdunit', 'tb_01.idskpd', 'tb_01.idjenjab') // Memilih kolom yang relevan
            ->get();
            dd($kepalaBidang);

        $staff = Tb01::where('kdunit', $user->kdunit)
            ->where('idjenkedudupeg', 1)
            ->select('tb_01.hp', 'tb_01.kdunit', 'tb_01.idskpd') // Memilih kolom yang relevan
            ->get();

            dd($staff);

        // Query to get sekretariat with proper column selection
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
            ->distinct() // Ensure distinct rows
            ->select('tb.hp', 'tb.kdunit', 'tb.idskpd', 'tb.idjenjab')
            ->get();

        // Output the results for debugging
        // dd($sekretariat->map(function ($item) {
        //     return [
        //         'hp' => $item->hp,
        //         'kdunit' => $item->kdunit,
        //         'idskpd' => $item->idskpd,
        //         'idjenjab' => $item->idjenjab
        //     ];
        // }));

        $pesan_sekre = 'Surat masuk perlu ditindaklanjuti Kepala Dinas';
        $pesan_kadin = 'Surat masuk perlu ditindaklanjuti Kepala Bidang';
        $pesan_kabid = 'Surat masuk sudah ditindaklanjuti Kepala Dinas dan Kepala Bidang';
        $pesan_revisi = 'Ada revisi surat masuk';
        $pesan_distribusikan = 'Silakan cek surat masuk terbaru';
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
        $this->validate([
            'form.jenis_agenda_tp' => 'nullable|string',
            'form.kode_lama' => 'nullable|string',
            'form.kode_baru' => 'nullable|string',
            'form.nomor_surat' => 'nullable|string',
            'form.opd_id' => 'nullable|string',
            'form.tgl_surat' => 'nullable|date',
            'form.tgl_terima' => 'nullable|date',
            'form.acara' => 'nullable|string',
            'form.tanggalBerangkat' => 'nullable|date',
            'form.tanggalPulang' => 'nullable|date',
            'form.jamMulai' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!strtotime($value)) {
                        $fail('The ' . $attribute . ' is not a valid time.');
                    }
                },
            ],
            'form.tempat' => 'nullable|string',
            'form.perihal' => 'nullable|string',
            'document_id' => 'required|exists:documents,id',
        ]);

        $this->form['document_id'] = $this->document_id;

        $suratmasuk = ModelsSuratMasuk::create($this->form);

        StatusSurat::updateOrCreate([
            'surat_masuk_id' => $suratmasuk->id,
            'status_surat' => 'Perlu Verifikasi Kepala Dinas',
        ]);

        // // Menyimpan data di KirimWA
        // $this->sendWhatsapp(); // Memanggil metode sendWhatsapp
        // KirimWA::dispatch($this->kepalaDinas, $this->pesan_sekre); // Pastikan variabel di-set sebelumnya

        return redirect()->to('/suratmasuk-index');
    }

    public function storeKadin()
    {
        $suratmasuk = ModelsSuratMasuk::findOrFail($this->suratmasukId);

        if (Gate::allows('kepala_dinas', Auth::user())) {
            foreach ($this->formTindakLanjut['diteruskan_kepada'] as $diteruskan_kepada) {
                TindakLanjut::updateOrCreate([
                    'surat_masuk_id' => $suratmasuk->id,
                    'diteruskan_kepada' => $diteruskan_kepada,
                ], [
                    'deskripsi' => $this->formTindakLanjut['deskripsi'],
                    'revisi' => $this->formTindakLanjut['revisi'] === 'revisi' ? true : false,
                    'disposisi' => null,
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip,
                ]);
            }
        }

        $statusSurat = $this->formTindakLanjut['revisi'] === 'revisi' ? 'Revisi' : 'Perlu Verifikasi Kepala Bidang';

        StatusSurat::updateOrCreate(
            ['surat_masuk_id' => $suratmasuk->id],
            ['status_surat' => $statusSurat]
        );

        return redirect()->to('/suratmasuk-index');
    }

    public function storeKabid()
    {
        $suratmasuk = ModelsSuratMasuk::findOrFail($this->suratmasukId);

        foreach ($this->formTindakLanjut['disposisi'] as $disposisi) {
            TindakLanjut::updateOrCreate([
                'surat_masuk_id' => $suratmasuk->id,
                'disposisi' => $disposisi,
                'diteruskan_kepada' => null,
                'revisi' => $this->formTindakLanjut['revisi'] === 'revisi' ? true : false,
                'nama' => Auth::user()->nama,
                'nip' => Auth::user()->nip
            ]);
        }

        StatusSurat::updateOrCreate(
            ['surat_masuk_id' => $suratmasuk->id],
            ['status_surat' => 'Sekretariat']
        );

        return redirect()->to('/suratmasuk-index');
    }

    public function storeUpdate()
    {
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
                'form.perihal' => 'nullable|string',
                'document_id' => 'required|exists:documents,id',
            ]);

            // Masukkan document_id ke dalam $form
            $this->form['document_id'] = $this->document_id;
            // Buat entri status surat baru dengan status 'Perlu Verifikasi Kepala Dinas'
            StatusSurat::updateOrCreate([
                'surat_masuk_id' => $suratmasuk->id,
            ], [
                'status_surat' => 'Perlu Verifikasi Kepala Dinas',
            ]);
        }
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
