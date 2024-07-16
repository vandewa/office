<?php

namespace App\Livewire\Surat;

use App\Models\Simpeg\Tb01;
use App\Models\StatusSurat;
use App\Models\SuratMasuk;
use App\Models\SuratMasukIndex as ModelsSuratMasukIndex;
use App\Models\TindakLanjut;
use Livewire\Component;
use Livewire\WithPagination;

class SuratMasukIndex extends Component
{
    use WithPagination;
    public $idHapus, $suratmasuks, $cari, $tindak_lanjuts, $status_surats, $data1, $filteredData, $showHeader = true;

    public function mount($showHeader = true)
    {
        $this->showHeader = $showHeader;
        // $this->suratmasuks = SuratMasuk::all();
        $this->tindak_lanjuts = TindakLanjut::all();
        $this->status_surats = StatusSurat::all();
        // $this->data1 = SuratMasuk::with(['tindakLanjuts', 'statusSurats'])->get();
        // $this->filteredData = SuratMasuk::orderBy('id', 'desc')->get();
    }

    public function getFilteredDataProperty()
    {
        return $this->data1->filter(function($item) {
            return $item->statusSurats->contains('status_surat', 'Sudah Distribusikan');
        });
    }


    public function delete($id)
    {
        $this->idHapus = $id;
        $this->hapus();
        $this->suratmasuks = $this->suratmasuks->except($id);
        // $this->filteredData = SuratMasuk::orderBy('id', 'desc')->get();
    }

    public function hapus()
    {
        SuratMasuk::destroy($this->idHapus);
        return redirect()->to('/suratmasuk-index');
    }

    public function render()
    {
        $data = ModelsSuratMasukIndex::query()
            ->with('tindakLanjuts', 'statusSurats')
            ->orderBy('id', 'desc')
            ->where('nomor_surat', 'like', '%' . $this->cari . '%')
            ->orWhere('acara', 'like', '%' . $this->cari . '%')
            ->paginate(5);

        $tindak_lanjuts = TindakLanjut::all();
        $status_surats = StatusSurat::all();

        return view('livewire.surat.surat-masuk-index', [
            'data' => $data,
            'tindakLanjut' => $tindak_lanjuts,
            'statusSurat' => $status_surats,
            'filteredData' => $this->filteredData
        ]);
    }
}
