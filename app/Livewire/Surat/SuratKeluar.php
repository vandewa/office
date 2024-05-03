<?php

namespace App\Livewire\Surat;

use App\Models\SuratKeluar as ModelsSuratKeluar;
use Livewire\Component;
use Livewire\WithFileUploads;

class SuratKeluar extends Component
{
    use WithFileUploads;

    public $nama, $suratmasuk, $suratmasukId = null, $edit = false;
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


    public function mount($id = null)
    {
        $this->suratmasukId = $id;
        if ($id) {
            $this->getEdit($id);
        } else {
            $this->edit = false;
        }
    }

    public function getEdit($id)
    {
        $this->edit = true;
        $this->suratmasuk = ModelsSuratKeluar::findOrFail($id);
        $this->form = array_intersect_key($this->suratmasuk->toArray(), $this->form);
    }

    public function save()
    {
        if ($this->edit === true) {
            $this->storeUpdate();
        } else {
            $this->store();
        }
    }

    public function store()
    {
        // Pastikan ada file yang diunggah sebelum menyimpan
        if ($this->form['dok_surat']) {
            // Mengunggah file dan mendapatkan path file
            $path = $this->form['dok_surat']->store('dokumen', 'public');

            // Menyimpan path file ke dalam database
            ModelsSuratKeluar::create([
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

        return redirect()-> to('/suratmasuk-index');
    }


    public function storeUpdate()
{
    $suratmasuk = ModelsSuratKeluar::findOrFail($this->suratmasukId);

    // Jika ada file yang diunggah, perbarui kolom dok_surat
    // if ($this->form['dok_surat']) {
    //     // Memperbarui kolom dok_surat dengan path file yang baru
    //     $path = $this->form['dok_surat']->store('dokumen', 'public');
    // }

    // Update kolom lainnya
    $suratmasuk->update([
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
        // Perbarui kolom dok_surat hanya jika ada file yang diunggah
        // 'dok_surat' => isset($path) ? $path : $suratmasuk->dok_surat
    ]);

    // Reset variabel setelah disimpan
    $this->reset();

    // Redirect ke halaman suratmasuk-index setelah data disimpan
    return redirect()->to('/suratmasuk-index');
}

    public function render()
    {
        $surat = ModelsSuratKeluar::first(); // Contoh pengambilan data surat, sesuaikan dengan kebutuhan Anda
        return view('livewire.surat.surat-keluar');
    }
}
