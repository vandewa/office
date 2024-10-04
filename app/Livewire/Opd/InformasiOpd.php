<?php

namespace App\Livewire\Opd;

use App\Models\InformasiOpd as ModelsInformasiOpd;
use App\Models\Simpeg\ASkpd;
use Livewire\Component;

class InformasiOpd extends Component
{
    public $form = [
        'kdunit' => null,
        'alamat' => null,
        'website' => null,
        'email' => null,
        'telepon' => null,
        'fax' => null,
    ];

    public $form2 = [
        'kdunit' => null,
        'akun' => null,
    ];

    public $namaOpd;

    public function mount()
    {
        $this->namaOpd = ASkpd::find(auth()->user()->kdunit)->skpd;

        $informasiOpd = ModelsInformasiOpd::where('kdunit', auth()->user()->kdunit)->first();
        if ($informasiOpd) {
            $this->form = $informasiOpd->toArray();
            $this->form2 = $informasiOpd->toArray();
        }

    }

    public function save()
    {
        $this->validate(
            [
                'form.alamat' => 'required',
                'form.website' => 'required',
                'form.email' => 'required',
                'form.telepon' => 'required',
                'form.fax' => 'required',
            ]
        );

        // The $data array should contain the necessary fields
        $attributes = [
            'kdunit' => auth()->user()->kdunit
        ];


        $this->form['kdunit'] = auth()->user()->kdunit;

        // Update the record if 'kdunit' exists, otherwise create a new one
        ModelsInformasiOpd::updateOrCreate($attributes, $this->form);

        $this->showSuccessMessage('Informasi telah diperbaharui!');

    }

    public function saveAnggaran()
    {
        $this->validate(
            [
                'form2.akun' => 'required',
            ]
        );

        // The $data array should contain the necessary fields
        $attributes = [
            'kdunit' => auth()->user()->kdunit
        ];


        $this->form2['kdunit'] = auth()->user()->kdunit;

        // Update the record if 'kdunit' exists, otherwise create a new one
        ModelsInformasiOpd::updateOrCreate($attributes, $this->form2);

        $this->showSuccessMessage('Informasi telah diperbaharui!');

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
                    window.location.href = '/informasi-opd'; // Ganti '/sppd-index' dengan route yang benar
                }
            });
        JS);
    }

    public function render()
    {
        return view('livewire.opd.informasi-opd');
    }
}
