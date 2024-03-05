<?php

namespace App\Livewire;

use App\Models\Simpeg\ASkpd;
use Livewire\Component;

class SppdIndex extends Component
{
    public function render()
    {
        // dd(ASkpd::limit(20)->get());
        return view('livewire.sppd-index');
    }
}
