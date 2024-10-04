<?php

namespace App\Livewire\Master;

use App\Models\Ssh as ModelsSsh;
use Livewire\Component;

class Ssh extends Component
{
    public $nama;

    public function edit()
    {
        $data = ModelsSsh::first();

        $this->nama = $data->nama;
    }

    public function save()
    {
        ModelsSsh::find(1)->update([
            'nama' => $this->nama
        ]);

        $this->showSuccessMessage('Data telah diperbaharui!');
    }

    private function showSuccessMessage($message)
    {
        $this->js(<<<JS
            Swal.fire({
                title: 'Berhasil!',
                text: '$message',
                icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/master/ssh'; // Ganti '/sppd-index' dengan route yang benar
                }
            });
        JS);
    }

    public function render()
    {
        $data = ModelsSsh::first();

        return view('livewire.master.ssh', [
            'data' => $data
        ]);
    }
}
