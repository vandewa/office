<?php

namespace App\Livewire\Sppd;

use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\Sppd;
use App\Models\SppdIndex as ModelsSppdIndex;
use App\Models\SppdPegawai;
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
    public $idHapus, $sppds, $cari;

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

    public function mount()
    {
        $this->sppds = Sppd::all();
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
            ->where('tempat_tujuan', 'like', '%' . $this->cari . '%')
            ->orWhere('maksud', 'like', '%' . $this->cari . '%')
            ->paginate(10);

            $sppdPegawai = SppdPegawai::all();

        return view('livewire.sppd.sppd-index', [
            'data' => $data,
            'sppdPegawai' => $sppdPegawai
        ]);
    }
}
