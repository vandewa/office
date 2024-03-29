<?php

namespace App\Livewire;

use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\Simpeg\ASkpd;
use App\Models\Sppd;
use Illuminate\Support\Facades\Http;

class SppdIndex extends Component
{
//     public function render()
//     {
//         $phone='6281393982874';
//         $message='bebas';
//         // dd(ASkpd::limit(20)->get());
// KirimWA::dispatch($phone, $message);
//         return view('livewire.sppd-index');
//     }

public $sppd;

    public function mount()
    {
        // Mengambil data sppd_pegawai dari database
        $this->sppd = Sppd::all();
    }

    public function render()
    {
        return view('livewire.sppd-index', [
            'sppd' => $this->sppd
        ]);
    }
}
