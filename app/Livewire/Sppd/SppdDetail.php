<?php

namespace App\Livewire\Sppd;

use Livewire\Component;

class SppdDetail extends Component
{
    public $readonly = false,  $sppdId = null;

    public function mount($id = null)
    {
        $this->sppdId = $id;
        $this->readonly = request()->routeIs('sppd-detail'); // Tentukan readonly berdasarkan route

    }

    public function getIsReadonlyProperty()
    {
        return $this->readonly;
    }


    public function render()
    {
        return view('livewire.sppd.sppd-detail');
    }
}
