<?php

namespace App\Livewire\Surat;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class UnggahDokumen extends Component
{
    use WithFileUploads;
    public $dok_surat;

    public function store()
    {
        $this->validate([
            'dok_surat' => 'file|mimes:pdf|max:10240',
        ]);

        $path = $this->dok_surat->store('dok_surat');

        Document::create([
            'dok_surat' => $path
        ]);
    }
    public function render()
    {
        return view('livewire.surat.unggah-dokumen');
    }
}
