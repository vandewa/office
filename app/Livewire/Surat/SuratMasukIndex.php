<?php

namespace App\Livewire\Surat;

use App\Models\SuratMasuk;
use Livewire\Component;

class SuratMasukIndex extends Component
{
    public $idHapus, $suratmasuks;

    public $form = [
        'jenis_agenda_tp' => null,
        'kode_lama' => null,
        'kode_baru' => null,
        'nomor_surat' => null,
        'opd_id' => null,
        'tgl_surat' => null,
        'tgl_terima' => null,
        'acara' => null,
        'tanggalBerangkat' => null,
        'tanggalPulang' => null,
        'jamMulai' => null,
        'tempat' => null,
        'perihal' => null,
        // 'no_surat' => null,
        'dok_surat' => null,
    ];

    public function mount()
    {
        $this->suratmasuks = SuratMasuk::all();
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->hapus();
        $this->suratmasuks = $this->suratmasuks->except($id);
    }

    public function hapus()
    {
        SuratMasuk::destroy($this->idHapus);
        return redirect()->to('/suratmasuk-index');
    }

    public function storeUpdate()
    {
        SuratMasuk::find($this->idHapus)->update($this->form);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.surat.surat-masuk-index', [
            'suratmasuks' => $this->suratmasuks
        ]);

    }
}
