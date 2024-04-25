<?php

namespace App\Livewire\Surat;

use App\Models\SuratMasuk as ModelsSuratMasuk;
use Livewire\Component;
use Livewire\WithFileUploads;

class SuratMasuk extends Component
{
    use WithFileUploads;

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

    public function store()
    {
        // Pastikan ada file yang diunggah sebelum menyimpan
        if ($this->form['dok_surat']) {
            // Mengunggah file dan mendapatkan path file
            $path = $this->form['dok_surat']->store('dokumen', 'public');

            // Menyimpan path file ke dalam database
        ModelsSuratMasuk::create([
            'jenis_agenda_tp' => $this->form['jenis_agenda_tp'],
            'kode_lama' => $this->form['kode_lama'],
            'kode_baru' => $this->form['kode_baru'],
            'nomor_surat' => $this->form['nomor_surat'],
            'opd_id' => $this->form['opd_id'],
            'tgl_surat' => $this->form['tgl_surat'],
            'tgl_terima' => $this->form['tgl_terima'],
            'acara' => $this->form['acara'],
            'tanggalBerangkat' => $this->form['tanggalBerangkat'],
            'tanggalPulang' => $this->form['tanggalPulang'],
            'jamMulai' => $this->form['jamMulai'],
            'tempat' => $this->form['tempat'],
            'perihal' => $this->form['perihal'],
            'dok_surat' => $path
        ]);
        }
    }


    public function save()
    {
        $this->store();
    }

    public function render()
    {
        $surat = ModelsSuratMasuk::first(); // Contoh pengambilan data surat, sesuaikan dengan kebutuhan Anda
        return view('livewire.surat.surat-masuk', ['surat' => $surat]);
    }
}
