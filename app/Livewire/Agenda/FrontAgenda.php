<?php

namespace App\Livewire\Agenda;

use Livewire\Component;

class FrontAgenda extends Component
{
    public function render()
    {
        return view('livewire.agenda.front-agenda')->layout('layouts.luar');
    }
}
