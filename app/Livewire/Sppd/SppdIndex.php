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

    public $idHapus, $sppds, $edit = false;

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

    public function getEdit($a)
    {
        $this->form = Sppd::find($a)->only(['untuk', 'tingkat_id', 'alat_angkut_st',
        'tempat_berangkat', 'tempat_tujuan', 'tgl_berangkat', 'tgl_kembali', 'hari',
        'ditetapkan_tgl', 'pengikut', 'keterangan']);
        $this->idHapus = $a;
        $this->edit = true;
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
        Sppd::create($this->form);
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
        $this->edit = false;
    }

    public function batal()
    {
        $this->edit = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.sppd.sppd-index', [
            'sppds' => $this->sppds
        ]);
    }
}
