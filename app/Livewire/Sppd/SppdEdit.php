<?php

namespace App\Livewire\Sppd;

use Livewire\Component;

class SppdEdit extends Component
{
    public $sppd;

    public function edit($id)
    {
        $this->sppd = Sppd::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.sppd.sppd-edit')->with('sppd', $this->sppd);
    }
}
