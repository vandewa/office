<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuratMasuk;
use App\Models\StatusSurat;
use App\Models\TindakLanjut;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Dashboard as ModelsDashboard;

class Dashboard extends Component
{
    use WithPagination;
    public $idHapus, $suratmasuks, $cari, $tindak_lanjuts, $status_surats, $data1;


    public function mount()
    {
        $this->suratmasuks = SuratMasuk::all();
        $this->tindak_lanjuts = TindakLanjut::all();
        $this->status_surats = StatusSurat::all();
        $this->data1 = SuratMasuk::with(['tindakLanjuts', 'statusSurats'])->get();
    }

    public function getFilteredDataProperty()
    {
        if (Gate::allows('kepala_dinas', Auth::user())) {
            return $this->data1->filter(function ($item) {
                return $item->statusSurats->contains('status_surat', 'Perlu Verifikasi Kepala Dinas');
            });
        } elseif (Gate::allows('kepala_bidang', Auth::user())) {
            return $this->data1->filter(function ($item) {
                return $item->statusSurats->contains('status_surat', 'Perlu Verifikasi Kepala Bidang');
            });
        } elseif (Gate::allows('sekretariat', Auth::user())) {
            return $this->data1->filter(function ($item) {
                return $item->statusSurats->contains('status_surat', 'Sekretariat');
            });
        } elseif (Gate::allows('staff', Auth::user())) {
            return $this->data1->filter(function ($item) {
                return $item->statusSurats->contains('status_surat', 'Sudah Distribusikan');
            });
        }
    }

    public function render()
    {
        $data = ModelsDashboard::query()
            ->with('tindakLanjuts', 'statusSurats')
            ->where('nomor_surat', 'like', '%' . $this->cari . '%')
            ->orWhere('acara', 'like', '%' . $this->cari . '%')
            ->paginate(10);

        $tindak_lanjuts = TindakLanjut::all();
        $status_surats = StatusSurat::all();

        return view('livewire.dashboard', [
            'data' => $data,
            'tindakLanjut' => $tindak_lanjuts,
            'statusSurat' => $status_surats,
            'filteredData' => $this->filteredData
        ]);
    }
}
