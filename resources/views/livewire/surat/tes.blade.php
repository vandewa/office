
<?php
namespace App\Livewire\Surat;
use Livewire\Component;
use App\Models\Simpeg\Tb01;
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
    public $suratkeluar, $skpd, $nama,  $opdOptions = [], $tindakLanjut, $edit = false, $suratkeluarId = null;
    public $form = [
        'nomor_surat'  => null,
        'tanggal_surat' => null,
        'perihal' => null,
        'tujuan' => null,
        'pembukaan_surat' => null,
        'isi_surat' => null,
        'penutup_surat' => null,
        'lampiran' => null,
    ];
    public $formTindakLanjut  = [
        'deskripsi' => null,
        'nama' => null,
        'nip' => null,
        'diteruskan_kepada' => [],
        'disposisi' => []
    ];
    public function mount($id = null)
    {
        $this->suratkeluar = ModelsSuratKeluar::findOrFail($id);
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
        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }
    }
    public function store()
    {
        $suratkeluar = ModelsSuratKeluar::create($this->form);
        StatusSurat::create([
            'surat_keluar_id' => $suratkeluar->id,
            'status_surat' => 'Perlu Verifikasi Kepala Dinas',
        ]);
    }
    public function storeUpdate()
    {
        $this->suratkeluar->update($this->form);
        $this->edit = false;
        $suratkeluar = ModelsSuratKeluar::findOrFail($this->suratkeluarId);
        if  (Gate::allows('kepala_dinas', Auth::user())) {
            // Create or update tindak lanjut records for Kepala Dinas without deleting existing ones
            foreach ($this->formTindakLanjut['diteruskan_kepada'] as $diteruskan_kepada) {
                TindakLanjut::updateOrCreate([
                    'surat_keluar_id' => $suratkeluar->id,
                    'deskripsi' => $this->formTindakLanjut['deskripsi'],
                    'diteruskan_kepada' => $diteruskan_kepada,
                    'nama' => Auth::user()->nama,
                    'nip' => Auth::user()->nip
                ]);
            }
            $statusSurat = StatusSurat::where('surat_keluar_id', $suratkeluar->id)->first();
            $statusSurat->update([
                'status_surat' => 'Perlu Verifikasi Kepala Bidang',
            ]);
    } elseif (Gate::allows('kepala_bidang', Auth::user())) {
        // Create or update tindak lanjut records for Kepala Bidang without deleting existing ones
        foreach ($this->formTindakLanjut['disposisi'] as $disposisi) {
            TindakLanjut::updateOrCreate([
                'suart_keluar_id' => $suratkeluar->id,
                'disposisi' => $disposisi,
                'nama' => Auth::user()->nama,
                'nip' => Auth::user()->nip
            ]);
        }
        $statusSurat = StatusSurat::where('suart_keluar_id', $suratkeluar->id)->first();
        $statusSurat->update([
            'status_surat' => 'Sekretariat',
        ]);
    }
    $statusSurat = StatusSurat::where('suart_keluar_id', $suratkeluar->id)->first();
        if ($statusSurat) {
            // Update status jika status surat saat ini adalah 'Sekretariat'
            if ($statusSurat->status_surat === 'Sekretariat') {
                $statusSurat->update([
                    'status_surat' => 'Sudah Distribusikan',
                ]);
            }
        }
}
    public function render()
    {
        $surat = ModelsSuratKeluar::first(); // Contoh pengambilan data surat, sesuaikan dengan kebutuhan Anda
        return view('livewire.surat.surat-keluar', [
            'surat' => $surat,
            'skpd' => $this->skpd,
            'nama' => $this->nama,
            'tindakLanjut' => $this->tindakLanjut
        ]);
    }
}