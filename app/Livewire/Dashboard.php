<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\StatusSurat;
use App\Models\TindakLanjut;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Dashboard as ModelsDashboard;

class Dashboard extends Component
{
    use WithPagination;
    public $idHapus, $cari, $tindak_lanjuts, $status_surats;

    public function mount()
    {
        $this->tindak_lanjuts = TindakLanjut::all();
        $this->status_surats = StatusSurat::all();
    }

    public function filteredSuratMasuk()
    {
        return SuratMasuk::with(['tindakLanjuts', 'statusSurats'])
            ->when(Gate::allows('kepala_dinas', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Perlu Verifikasi Kepala Dinas');
                });
            })
            ->when(Gate::allows('kepala_bidang', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Perlu Verifikasi Kepala Bidang');
                });
            })
            ->when(Gate::allows('sekretariat', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Sekretariat');
                });
            })
            ->when(Gate::allows('staff', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Sudah Distribusikan');
                });
            })
            ->get();
    }

    public function filteredSuratKeluar()
    {
        return SuratKeluar::with(['tindakLanjuts', 'statusSurats'])
            ->when(Gate::allows('kepala_dinas', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Perlu Verifikasi Kepala Dinas');
                });
            })
            ->when(Gate::allows('kepala_bidang', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Perlu Verifikasi Kepala Bidang');
                });
            })
            ->when(Gate::allows('sekretariat', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Sekretariat');
                });
            })
            ->when(Gate::allows('staff', Auth::user()), function ($query) {
                $query->whereHas('statusSurats', function ($q) {
                    $q->where('status_surat', 'Sudah Distribusikan');
                });
            })
            ->get();
    }

    public function render()
    {
        $suratMasuk = $this->filteredSuratMasuk();
        $suratKeluar = $this->filteredSuratKeluar();

        return view('livewire.dashboard', [
            'suratMasuk' => $suratMasuk,
            'suratKeluar' => $suratKeluar,
            'tindakLanjut' => $this->tindak_lanjuts,
            'statusSurat' => $this->status_surats,
        ]);
    }
}
