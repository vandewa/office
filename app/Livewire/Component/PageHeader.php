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
    public function render()
    {
        return view('livewire.component.page-header');
    }
}
