<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\StatusSurat;
use App\Models\SuratKeluar;
use App\Models\TindakLanjut;
use Livewire\WithPagination;
use App\Models\SuratKeluarIndex as ModelsSuratKeluarIndex;

class SuratKeluarIndex extends Component
{
    use WithPagination;
    public $idHapus, $suratkeluars, $cari, $tindak_lanjuts, $status_surats, $data2, $filteredData, $showHeader = true;

    public function mount($showHeader = true)
    {
        $this->showHeader = $showHeader;
        $this->suratkeluars = Suratkeluar::all();
        $this->tindak_lanjuts = TindakLanjut::all();
        $this->status_surats = StatusSurat::all();
        // $this->data2 = Suratkeluar::with(['tindakLanjuts', 'statusSurats'])->get();
        // $this->filteredData = Suratkeluar::orderBy('id', 'desc')->get();
    }

    public function getFilteredDataProperty()
    {
        return $this->data2->filter(function ($item) {
            return $item->statusSurats->contains('status_surat', 'Sudah Distribusikan');
        });
    }

    // public function delete($id)
    // {
    //     $this->idHapus = $id;
    //     $this->hapus();
    //     $this->suratkeluars = $this->suratkeluars->except($id);
    // }

    // public function hapus()
    // {
    //     SuratKeluar::destroy($this->idHapus);
    //     $this->idHapus = null; // Reset idHapus after deletion
    //     return redirect()->to('/suratkeluar-index');
    // }


    public function delete($id)
    {
        $this->idHapus = $id;
        $this->hapus();
        // $this->suratkeluars = $this->suratkeluars->except($id);
        $this->suratkeluars = $this->suratkeluars->where('id', '!=', $id);
        $this->filteredData = Suratkeluar::orderBy('id', 'desc')->get();
    }

    public function hapus()
    {
        Suratkeluar::destroy($this->idHapus);
        // return redirect()->to('/suratkeluar-index');
    }

    public function render()
    {
        $data = ModelsSuratkeluarIndex::query()
            ->with('tindakLanjuts', 'statusSurats')
            ->orderBy('id', 'desc')
            ->where('nomor_surat', 'like', '%' . $this->cari . '%')
            ->orWhere('tujuan', 'like', '%' . $this->cari . '%')
            ->paginate(5);

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
