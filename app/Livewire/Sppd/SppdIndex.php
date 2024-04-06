<?php

namespace App\Livewire\Sppd;

use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\Sppd;

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

    public $idHapus, $sppds;

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

    public function mount()
    {
        // Mengambil data sppd_pegawai dari database
        $this->sppds = Sppd::all();
    }

    // //mengarahkan ke halamna edit
    // public function getEdit($id)
    // {
    //     $this->sppds = Sppd::findOrFail($id);
    //     return redirect()->route('sppd-edit', ['id' => $id]);
    // }

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
        return view('livewire.sppd.sppd-index', [
            'sppds' => $this->sppds
        ]);
    }
}
