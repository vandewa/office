<?php

namespace App\Livewire\Surat;

use App\Jobs\KirimWA;
use Livewire\Component;
use Illuminate\Http\Request;

class SuratMasuk extends Component
{
    // public function render()
    // {
    //     $phone='6281393982874';
    //     $message='rr';
    //     // dd(ASkpd::limit(20)->get());
    //     KirimWA::dispatch($phone, $message);
    //     return view('livewire.surat.surat-masuk');
    // }

    public $phone;
    public $message;

    public function sendMessage()
    {
        KirimWA::dispatch($this->phone, $this->message);
        $this->phone = '';
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.surat.surat-masuk');
    }
}
