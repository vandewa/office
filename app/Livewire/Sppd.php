<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Simpeg\Tb01;
use Illuminate\Support\Facades\Auth;

class Sppd extends Component
{
    public $nama;

    public function mount()
    {
        $nip = Auth::user()->nip;
            if (Auth::check()) {
                $kdunit = Tb01::where('nip', $nip)->value('kdunit');
                $this->nama = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
                                ->where('a_skpd.kdunit', $kdunit)
                                ->where('idjenkedudupeg', 1)
                                ->distinct('tb_01.nama')
                                ->pluck('tb_01.nama');
                            }
}

    public function render()
    {
        return view('livewire.sppd');
    }
}
