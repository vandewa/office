<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

class SuratChart extends Component
{
    public $suratMasukCount;
    public $suratKeluarCount;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->suratMasukCount = SuratMasuk::count();
        $this->suratKeluarCount = SuratKeluar::count();
    }

    public function render()
    {
        return view('livewire.surat-chart');
    }
}
