<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\Simpeg\Tb01;
use App\Models\Simpeg\ASkpd;
use App\Models\TindakLanjut;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\SuratMasuk as ModelsSuratMasuk;
class SuratMasuk extends Component
{
    use WithFileUploads;

    public $nama, $suratmasuk, $opdOptions = [], $suratmasukId = null, $edit = false, $readonly = false;
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
        'dok_surat' => null,
    ];

    public $formTindakLanjut  = [
        'deskripsi' => null,
        'nama' => null,
        'nip' => null,
        'diteruskan_kpd' => null
    ];

    public $formStatusSurat = [
        'status_surat' => null
    ];

    public function mount($id = null)
    {
        $this->suratmasuk = ModelsSuratMasuk::findOrFail($id);
        $this->readonly = request()->routeIs('suratmasuk-detail'); // Tentukan readonly berdasarkan route
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
        $nip = Auth::user()->nip;
        if (Auth::check()) {
            $kdunit = Tb01::where('nip', $nip)->value('kdunit');
            $this->nama = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
                ->where('a_skpd.kdunit', $kdunit)
                ->where('idjenkedudupeg', 1)
                ->whereColumn('tb_01.idjabjbt', 'tb_01.idskpd')
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
    
    public function store()
    {
        // // Pastikan ada file yang diunggah sebelum menyimpan
        if ($this->form['dok_surat']) {
            // Mengunggah file dan mendapatkan path file
            $path = $this->form['dok_surat']->store('dokumen', 'public');
            // Menyimpan path file ke dalam database
            ModelsSuratMasuk::create([
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
                'dok_surat' => $path
            ]);
            // $suratmasuk = ModelsSuratMasuk::create($this->form);
            // if (Gate::allows('kepala_dinas', Auth::user())) {
            //     TindakLanjut::create([
            //         // 'surat_masuk_id' => $suratmasuk->id,
            //         'deskripsi' => $this->formTindakLanjut['deskripsi'],
            //         'diteruskan_kpd' => $this->formTindakLanjut['diteruskan_kpd'],
            //         'nama' => Auth::user()->nama,
            //         'nip' => Auth::user()->nip
            //     ]);
            // }
            // Redirect ke halaman suratmasuk-index setelah data disimpan
            return redirect()->to('/suratmasuk-index');
            // return response()->json(['success' => true]);
        }
    }

    public function storeUpdate()
    {
        $suratmasuk = ModelsSuratMasuk::findOrFail($this->suratmasukId);
        // Jika ada file yang diunggah, perbarui kolom dok_surat
        // if ($this->form['dok_surat']) {
        //     // Memperbarui kolom dok_surat dengan path file yang baru
        //     $path = $this->form['dok_surat']->store('dokumen', 'public');
        // }
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
        // Reset variabel setelah disimpan
        $this->reset();
        // Redirect ke halaman suratmasuk-index setelah data disimpan
        return redirect()->to('/suratmasuk-index');
    }
    public function getIsReadonlyProperty()
    {
        return $this->readonly;
    }
    public function show($id)
    {
        $this->suratmasuk = ModelsSuratMasuk::findOrFail($id);
    }
    public function render()
    {
        // $surat = ModelsSuratMasuk::first(); // Contoh pengambilan data surat, sesuaikan dengan kebutuhan Anda
        // return view('livewire.surat.surat-masuk', ['surat' => $surat]);
        return view('livewire.surat.surat-masuk', [
            'suratmasuk' => $this->suratmasuk
        ]);
    }


    // public function render()
    // {
    //     return view('livewire.surat.surat-masuk');
    // }
}
