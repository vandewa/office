<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\StatusSurat;
use App\Models\SuratKeluar;
use App\Models\SuratKeluarIndex as ModelsSuratKeluarIndex;
use App\Models\TindakLanjut;

class SuratKeluarIndex extends Component
{
    public $idHapus, $suratkeluars,  $cari, $tindak_lanjuts, $status_surats, $data2;
    // Inisialisasi data pada mount
    public function mount()
    {
        $this->suratkeluars = SuratKeluar::all();
        $this->tindak_lanjuts = TindakLanjut::all();
        $this->status_surats = StatusSurat::all();
        $this->data2 = Suratkeluar::with(['tindakLanjuts', 'statusSurats'])->get();
    }

    public function getFilteredDataProperty()
    {
        return $this->data2->filter(function ($item) {
            return $item->statusSurats->contains('status_surat', 'Sudah Distribusikan');
        });
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
        $data = ModelsSuratKeluarIndex::query()
            ->with('tindakLanjuts', 'statusSurats')
            ->where('nomor_surat', 'like', '%' . $this->cari . '%')
            ->orWhere('acara', 'like', '%' . $this->cari . '%')
            ->paginate(10);

        $tindak_lanjuts = TindakLanjut::all();
        $status_surats = StatusSurat::all();

        return view('livewire.surat.surat-keluar-index', [
            'data' => $data,
            'tindakLanjut' => $tindak_lanjuts,
            'statusSurat' => $status_surats,
            'filteredData' => $this->filteredData
        ]);
    }
}
