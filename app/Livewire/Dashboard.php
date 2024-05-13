<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuratMasuk;
use App\Models\Dashboard as ModelsDashboard;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $suratmasuks, $cari;
    public $form = [
        'jenis_agenda_tp' => null,
        'kode_lama' => null,
        'kode_baru' => null,
        'nomor_surat' => null,
        'opd_id' => null,
        'tgl_surat' => null,
        'tgl_terima' => null,
        'acara' => null,
        'tanggalBerangkat' => null,
        'tanggalPulang' => null,
        'jamMulai' => null,
        'tempat' => null,
        'perihal' => null,
        // 'no_surat' => null,
        'dok_surat' => null,
    ];

    public function mount()
    {
        $this->suratmasuks = SuratMasuk::all();
    }
    public function render()
    {
        $data = ModelsDashboard::query()
        ->where('nomor_surat', 'like', '%' . $this->cari . '%')
        ->orWhere('acara', 'like', '%' . $this->cari . '%')
        ->paginate(10);
        return view('livewire.dashboard', ['data' => $data]);
    }
}
