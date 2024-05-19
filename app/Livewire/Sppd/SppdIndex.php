<?php

namespace App\Livewire\Sppd;

use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\Sppd;
use App\Models\SppdIndex as ModelsSppdIndex;
use App\Models\SppdPegawai;
use App\Models\StatusLaporan;
use Livewire\WithPagination;

class SppdIndex extends Component
{
    //     public function render()
    //     {
    //         $phone='6281393982874';
    //         $message='bebas';
    //         // dd(ASkpd::limit(20)->get());
    // KirimWA::dispatch($phone, $message);
    //         return view('livewire.sppd-index');
    //     }

    use WithPagination;
    public $idHapus, $sppds, $cari, $status_laporans;

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

    public $formNama = [
        'nip' => null
    ];

    public $formStatus = [
        'status_laporan' => null
    ];

    public function mount()
    {
        $this->sppds = Sppd::all();
        $this->status_laporans = StatusLaporan::all();
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->hapus();
        // Hapus entri yang dihapus dari koleksi sppds
        $this->sppds = $this->sppds->except($id);
    }

    public function hapus()
    {
        Sppd::destroy($this->idHapus);
        return redirect()->to('/sppd-index');
    }

    public function storeUpdate()
    {
        Sppd::find($this->idHapus)->update($this->form);
        $this->reset();
    }

    public function render()
    {
        $data = Sppd::query()
        ->with('statusLaporans') // Include related status laporans
            ->where('tempat_tujuan', 'like', '%' . $this->cari . '%')
            ->orWhere('maksud', 'like', '%' . $this->cari . '%')
            ->paginate(5);

            $sppdPegawai = SppdPegawai::all();
            $status_laporans = StatusLaporan::all();

        return view('livewire.sppd.sppd-index', [
            'data' => $data,
            'sppdPegawai' => $sppdPegawai,
            'statusLaporan' => $status_laporans
        ]);
    }
}
