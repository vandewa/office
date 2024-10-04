<?php

namespace App\Livewire\Surat;

use App\Models\Opd;
use App\Jobs\KirimWA;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Http\Request;

class SuratMasuk extends Component
{
    public $bukaInstansi = false, $opd;

    public $form = [
        'kode_lama' => null,
        'kode_baru' => null,
        'nomor_surat' => null,
        'tanggal_surat' => null,
        'tanggal_terima' => null,
        'opd_id' => null,
        'nama_instansi' => null,
        'perihal' => null,
        'tanggal_mulai' => null,
        'tanggal_selesai' => null,
        'jam_mulai' => null,
        'tempat' => null,
        'path_surat' => null,
    ];


    public function mount()
    {
        $this->form['tanggal_surat'] = date('Y-m-d');
        $this->form['tanggal_terima'] = date('Y-m-d');
        $this->form['tanggal_mulai'] = date('Y-m-d');
        $this->form['tanggal_selesai'] = date('Y-m-d');
        $this->form['jam_mulai'] = '07:00:00';
    }

    #[On('pilih-opd')]
    public function pilihOpd($id = "")
    {
        $this->opd = Opd::find($id);
        $this->form['opd_id'] = $this->opd->id;
    }

    // public function updated($property)
    // {
    //     if ($property === 'form.opd_id') {
    //         dd('a');
    //         if ($this->form['opd_id'] == 41) {
    //             dd('a');
    //         } else {
    //             $this->bukaInstansi = false;
    //         }
    //     }
    // }

    public function save()
    {
        $this->validate(
            [
                'form.nomor_surat' => 'required',
                'form.tanggal_surat' => 'required',
                'form.perihal' => 'required',
                'form.tempat' => 'required',
            ],
            [
                'form.nomor_surat.required' => 'Tanggal Kembali tidak boleh kurang dari Tanggal Berangkat',
                'form.tanggal_surat.required' => 'Tanggal Kembali tidak boleh kurang dari Tanggal Berangkat',
                'form.perihal.required' => 'Tanggal Kembali tidak boleh kurang dari Tanggal Berangkat',
                'form.tempat.required' => 'Tanggal Kembali tidak boleh kurang dari Tanggal Berangkat',
            ]
        );

    }

    public function render()
    {
        return view('livewire.surat.surat-masuk', [

        ]);
    }
}
