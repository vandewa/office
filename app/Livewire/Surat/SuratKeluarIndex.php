<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\StatusSurat;
use App\Models\SuratKeluar;

class SuratKeluarIndex extends Component
{
    public $idHapus, $suratkeluars, $status_surats;

    public $formStatus = [
        'status_surat' => null
    ];
    // Inisialisasi data pada mount
    public function mount()
    {
        $this->suratkeluars = SuratKeluar::all();
        $this->status_surats = StatusSurat::all();
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->hapus();
        $this->suratkeluars = $this->suratkeluars->except($id);
    }

    public function hapus()
    {
        SuratKeluar::destroy($this->idHapus);
        $this->idHapus = null; // Reset idHapus after deletion
        return redirect()->to('/suratkeluar-index');
    }


    public function render()
    {
        $status_surats = StatusSurat::all();
        $data = SuratKeluar::query()
            ->with('statusSurats')
            ->paginate(10);

        return view('livewire.surat.surat-keluar-index', [
            'data' => $data,
            'statusSurat' => $status_surats,
        ]);
    }
}
