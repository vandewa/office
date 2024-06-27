<?php

namespace App\Livewire\Surat;

use App\Jobs\KirimWA;
use Livewire\Component;
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

    public $nama, $suratmasuk, $opdOptions = [], $suratmasukId = null, $edit = false, $readonly = false, $skpd, $tindakLanjut;
    // public $dok_surat;
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
        // 'dok_surat' => null,
    ];

    public $formTindakLanjut  = [
        'deskripsi' => null,
        'nama' => null,
        'nip' => null,
        'diteruskan_kepada' => [],
        'disposisi' => []
    ];

    public $formStatusSurat = [
        'status_surat' => null
    ];

    public function mount($id = null)
    {
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
        // $this->validate([
        //     'dok_surat' => 'file|mimes:pdf|max:10240', // 10MB Max and only PDF files
        // ]);
        // // Simpan file dan dapatkan path-nya
        // $path = $this->dok_surat->store('dok_surat');

        // Menyimpan path file ke dalam database dan membuat entri surat masuk baru
        $suratmasuk = ModelsSuratMasuk::create([
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
            // 'dok_surat' => $path
        ]);

        // Buat entri status surat baru dengan status 'Verifikasi Kepala Dinas'
        StatusSurat::create([
            'surat_masuk_id' => $suratmasuk->id,
            'status_surat' => 'Perlu Verifikasi Kepala Dinas',
        ]);

        // Kirim pesan WhatsApp setelah laporan disimpan
        $phone = "081393982874"; // Nomor telepon untuk status Selesai
        $message = "k1"; // ke kadin
        $this->sendWhatsApp($phone, $message);

        // Redirect ke halaman suratmasuk-index setelah data disimpan
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
                'perihal' => $this->form['perihal'],
                'dok_surat' => isset($path) ? $path : $suratmasuk->dok_surat
            ]);
        } elseif (Gate::allows('kepala_dinas', Auth::user())) {
            // Create or update tindak lanjut records for Kepala Dinas without deleting existing ones
            foreach ($this->formTindakLanjut['diteruskan_kepada'] as $diteruskan_kepada) {
                TindakLanjut::updateOrCreate([
                    'surat_masuk_id' => $suratmasuk->id,
                    'deskripsi' => $this->formTindakLanjut['deskripsi'],
                    'diteruskan_kepada' => $diteruskan_kepada,
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip
                ]);
            }
            $statusSurat = StatusSurat::where('surat_masuk_id', $suratmasuk->id)->first();
            $statusSurat->update([
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
            ]);
            // Kirim pesan WhatsApp setelah laporan disimpan
            $phone = "081393982874"; // Nomor telepon untuk status Selesai
            $message = "k2"; // ke kabid
            $this->sendWhatsApp($phone, $message);
        } elseif (Gate::allows('kepala_bidang', Auth::user())) {
            // Create or update tindak lanjut records for Kepala Bidang without deleting existing ones
            foreach ($this->formTindakLanjut['disposisi'] as $disposisi) {
                TindakLanjut::updateOrCreate([
                    'surat_masuk_id' => $suratmasuk->id,
                    'disposisi' => $disposisi,
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip
                ]);
            }
            $statusSurat = StatusSurat::where('surat_masuk_id', $suratmasuk->id)->first();
            $statusSurat->update([
                'status_surat' => 'Sekretariat',
            ]);
            // Kirim pesan WhatsApp setelah laporan disimpan
            $phone = "081393982874"; // Nomor telepon untuk status Selesai
            $message = "k3"; // ke sekretariat
            $this->sendWhatsApp($phone, $message);
        }

        // Reset variabel setelah disimpan
        $this->reset();

        // Redirect ke halaman suratmasuk-index setelah data disimpan
        return redirect()->to('/suratmasuk-index');
    }

    public function distribusikan()
    {
        if (Gate::allows('sekretariat', Auth::user())) {
            $statusSurat = StatusSurat::where('surat_masuk_id', $this->suratmasuk->id)->first();

            if ($statusSurat) {
                // Update status if the current status is 'Sekretariat'
                if ($statusSurat->status_surat === 'Sekretariat') {
                    $statusSurat->update([
                        'status_surat' => 'Sudah Distribusikan',
                    ]);

                    // Send WhatsApp message after status is updated
                    $phone = "081393982874"; // Phone number for status Selesai
                    $message = "k4"; // Message to all staff
                    $this->sendWhatsApp($phone, $message);
                }
            }
        }
        // Redirect ke halaman suratmasuk-index setelah data disimpan
        return redirect()->to('/suratmasuk-index');
    }

    public function getIsReadonlyProperty()
    {
        return $this->readonly;
    }

    public function render()
    {
        $surat = ModelsSuratMasuk::first(); // Contoh pengambilan data surat, sesuaikan dengan kebutuhan Anda
        return view('livewire.surat.surat-masuk', [
            'surat' => $surat,
            'skpd' => $this->skpd,
            'nama' => $this->nama,
            'tindakLanjut' => $this->tindakLanjut
        ]);
    }
}
