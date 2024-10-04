<?php

namespace App\Livewire\Component;

use App\Models\Opd;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ModalOpd extends Component
{
    use WithPagination;
    public $search;
    public $modal = false;

    public function pilih($id)
    {
        $this->dispatch('pilih-opd', $id);
        $this->showModal();
    }


    #[On('show-modal-opd')]
    public function showModal()
    {
        $this->modal = !$this->modal;
        $this->search = null;
        $this->js(<<<'JS'
            setTimeout(() => {
                document.getElementById('search-opdd').focus();
        }, 300);
        JS);
    }

    public function render()
    {
        $data = Opd::cari($this->search)->orderBy('nama_opd_lengkap', 'asc')->paginate(7);

        return view('livewire.component.modal-opd', [
            'posts' => $data
        ]);
    }
}
