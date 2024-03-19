<?php

namespace App\Livewire\Pegawai;

use Livewire\Component;
use App\Models\Simpeg\Tb01;
use App\Models\Simpeg\ASkpd;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPegawai as ModelsDataPegawai;

class DataPegawai extends Component
{
    public $tb01;
    public $askpd;
    public $data;
    public function mount()
    {
        $kdunit = Auth::user()->kdunit;
        $this->tb01 = Tb01::where('kdunit', $kdunit)->where('idjenkedudupeg', 1)->get();
        $this->askpd = ASkpd::where('kdunit', $kdunit)->get();
    }
    public function render()
    {
        return view('livewire.pegawai.data-pegawai');
    }
}
