<?php

namespace App\Livewire\Component;

use Livewire\Component;

class PageHeader extends Component
{
    public $judul = "";
    public $subjudul = "";
    public $breadcrumb = [];
    public $button;

    public function add()
    {
        $this->dispatch('add');
    }

    public function mandiri()
    {
        return $this->redirect('tamu-mandiri', navigate: true);
    }

    public function agenda()
    {
        return $this->redirect('front-agenda', navigate: true);
    }
    public function render()
    {
        return view('livewire.component.page-header');
    }
}
